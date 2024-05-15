<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\InviteesRepo;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;



class LinkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $inviteesRepo;


    public function __construct(InviteesRepo $inviteesRepo)
    {
        // INITIATE REPOS
        $this->inviteesRepo = $inviteesRepo;
    }
    public function index(Request $request,$id)
    {
        // Validate the signed URL
//        if (!$request->hasValidSignature()) {
//            abort(401, 'Invalid or expired signature');
//        }

        $user = $this->inviteesRepo->find($id);

        return view('share-link',compact('user'));
    }


    public function updateStatus($id,Request $request){

        $data['reason'] = $request->reason ?? $request->reason;
        $data['status'] = $request->status ?? $request->status;

         $this->inviteesRepo->update($data , $id);
         if($request->status == 'accepted'){
             Session::flash('success', 'تم تأكيد الحضور!');
             $msg ='تم تأكيد الحضور!';
         }else{
             Session::flash('fail', 'تم الاعتذار عن الحضور!');
             $msg ='تم الاعتذار عن الحضور!';
         }

        return response()->json([
            'status' => 1,
            'message' => $msg,
        ]);
    }
}
