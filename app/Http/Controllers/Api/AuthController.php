<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ProfileResource;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\VerifyCode;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{


    public function login(Request $request)
    {
        $validator = $request->validate([
//            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'fcm_token' => 'nullable',
        ]);

        $user = User::where('phone',$request->phone)->first();

        if (!($user && Hash::check($request->password, $user->password))) {
            $msg = __('lang.invalid_credentials');
            return sendError( $msg , ['error' => 'خطأ في بيانات الدخول']);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $user->update(['password'=> \Illuminate\Support\Str::random(10) ,'is_verify' => 1 ,
            'fcm_token' => $request->fcm_token]);

        $data = [
            'user' => new UserResource($user),
            'token' => $token
        ];

         $msg = __('lang.success_login');

        return sendResponse($msg, $data);
    }

    public function signUp(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
        ]);

        $activation_code = 1234 ;
//        $activation_code = rand(1000, 9999) ;
        $data['password']= $activation_code;
        $data['code']= $activation_code ;
        $checkUser= User::where('phone',$request->phone)->first();

       if($checkUser){
           $message_whatsapp = ' كود التفعيل الخاص بك هو ' . $activation_code . '
اهلا  بك في تطبيق يباب 😀                        ';
//           whatsapp($request->phone, $message_whatsapp);
           $checkUser->update(['password'=> $activation_code ,
               'code'=> $activation_code ,
               'is_verify' => 0 ]);

           $msg = __('lang.done');
           return  sendResponse($msg,[]);
       }

        $data['is_verify']= 0;
        $data['country_id']= $request['city_id'];
        unset($data['city_id']);

        $message_whatsapp = ' كود التفعيل الخاص بك هو ' . $activation_code . '
اهلا  بك في تطبيق يباب 😀                        ';
//        whatsapp($request->phone, $message_whatsapp);

        User::query()->create($data);
//        $user->notify(new VerifyCode($user->code));
        $msg = __('lang.success_register');
        return  sendResponse($msg,[]);

    }

    public function sendCode(Request $request){
        $request->validate([
            'phone' => 'required',
        ]);

        $user = User::where('phone',$request->phone)->first();

        if (!$user) {
            $msg = __('lang.invalid_credentials');
            return sendError( $msg , ['error' => 'المستخدم غير موجود']);
        }

        $activation_code =  1234 ;
//        $activation_code = rand(1000, 9999) ;

        $message_whatsapp = ' كود التفعيل الخاص بك هو ' . $activation_code . '
اهلا  بك في تطبيق يباب 😀                        ';
//         whatsapp($request->phone, $message_whatsapp);

        //$password = rand(1000, 9999);

         $user->update(['password'=> $activation_code ,
                         'code'=> $activation_code ,
                         'is_verify' => 0 ]);

//        $user->notify(new VerifyCode($user->code));

        $msg = __('lang.done');
        return  sendResponse($msg,[]);



    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        $msg = __('lang.success_logout');
        return sendResponse($msg, []);

     }

     public function updateProfile(Request $request){
        $user =Auth::user();

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'image' => 'nullable',
            'phone' => 'required|unique:users,phone,'.$user->id,
            'email' => 'nullable|email|unique:users,email,'.$user->id,

         ]);
         $user->update($data);

         $msg = __('lang.done');
         return  sendResponse($msg,new ProfileResource($user));
     }

    public function showProfile(){

        $user =Auth::user();

        $msg = __('lang.done');
        return  sendResponse($msg,new ProfileResource($user));
    }

//    public function verify(Request $request)
//    {
//        $request->validate([
//            'code' => 'required'
//        ]);
//        $user = Auth::guard('api')->user();
//
//        if (!$user || $user->code != $request->code ) {
//
//            $msg = __('lang.invalid_verification_code');
//
//            return sendError( $msg , []);
//
//        }else {
//            $token = $user->createToken('authToken')->plainTextToken;
//
//            User::query()->where('id', $user->id)->update(['is_verify' => 1]);
//            $msg = __('lang.verify_has_ben_done');
//            $data = [
//                'user' => new UserResource($user),
//            ];
//            return sendResponse($msg , $data);
//        }
//
//    }
}
