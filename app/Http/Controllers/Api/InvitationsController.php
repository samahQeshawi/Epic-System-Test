<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InvitationRequest;
use App\Models\Order;
use App\Repositories\InviteesRepo;
use Intervention\Image\Facades\Image;
use App\Http\Resources\InvitationTypeResource;
use App\Http\Resources\CouponResource;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\InviteesListResource;
use App\Http\Resources\UserResource;
use App\Models\Invitation;
use App\Models\InvitationType;
use App\Models\AdditionalPackage;
use App\Models\InviteesList;
use App\Repositories\InvitationAddressRepo;
use App\Repositories\InvitationRepo;
use App\Repositories\CouponRepo;
use App\Repositories\PackageRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Jobs\SendInvitations;
use Imagick;
use App\Traits\PaymentTrait;





class InvitationsController extends Controller
{
    use PaymentTrait;
    private $invitationRepo;
    private $couponRepo;
    private $packageRepo;
    private $addressRepo;
    private $inviteesRepo;



    public function __construct(InvitationRepo $invitationRepo ,CouponRepo $couponRepo,PackageRepo $packageRepo,
                                InvitationAddressRepo $addressRepo ,InviteesRepo $inviteesRepo)
    {
        // INITIATE REPOS
        $this->invitationRepo = $invitationRepo;
        $this->couponRepo = $couponRepo;
        $this->packageRepo = $packageRepo;
        $this->addressRepo = $addressRepo;
        $this->inviteesRepo = $inviteesRepo;
        $this->initializeTrait();
    }

    public function index(){

        $user_id= Auth::user()->id;
        $invitations = $this->invitationRepo->where('user_id',$user_id)->withCount('inviteesWaiting')
            ->withCount('inviteesAttendees')->withCount('inviteesAccepted')->withCount('inviteesRejected')->get();

        $msg = __('lang.done');
        return sendResponse($msg,InvitationResource::collection($invitations));
    }

    public function store(InvitationRequest $request)
    {
        $user_id= Auth::user()->id;

        $data = $request->validated();

        $package =$this->packageRepo->find($request->package_id);
        $address =$this->addressRepo->find($request->invitation_address_id);

        if($request->is_logo_remove == 1){
           $logo_remove_price = 4 ;
           $is_logo = 'yes' ;
        } else{
            $logo_remove_price = 0 ;
            $is_logo = 'no';
        }

        if($request->coupon_id != null){
            $coupon =$this->couponRepo->find($request->coupon_id);
            $coupon_price = $coupon->discount;
        } else{
            $coupon_price =0;
        }

        $total = $package->price + $coupon_price + $logo_remove_price ;

        $data['user_id'] = $user_id;
        $data['coupon_val'] = $coupon_price;
        $data['package_price'] = $package->price;
        $data['logo_remove_price'] = $logo_remove_price;
        $data['total'] =$total;

        $position_qr =$request->Qrcode_place;
        $position_logo = 'top-left';

        $imageFile = $request->file('image');
        $imageWidth = Image::make($imageFile)->width();
        $qrcodeSize = round(20 * $imageWidth / 100);

        $latitude = $address->lat;
        $longitude = $address->long;
        $nameFileQrcode = $this->generateQrcode($latitude,$longitude,$qrcodeSize);
        $data['Qrcode'] = $nameFileQrcode;

        if($position_qr == 'top-left'){
            $position_logo = 'top-right';
        }

        $nameFileImage = $this->generateImage($imageFile,$nameFileQrcode ,$position_qr ,$position_logo,$is_logo ,$request->method_type);
        $data['image'] = $nameFileImage;

        $invitation = $this->invitationRepo->create($data);

        $remaining_num = $package->num_invitations;
         if($request->method_type == 'numbered'){
             $this->createInviteesList( $package->num_invitations ,$invitation->id);
             $remaining_num = 0 ;
         }

        $package_data=[
            'invitation_id'=> $invitation->id ,
            'package_id'=> $package->id ,
            'package_price'=> $package->price ,
            'invitations_num'=>$package->num_invitations ,
            'remaining_num'=> $remaining_num,
        ];
        AdditionalPackage::create($package_data);
        $invitation->invitees_waiting_count=$invitation->inviteesWaiting()->count();
        $invitation->invitees_attendees_count=$invitation->inviteesAttendees()->count();
        $invitation->invitees_accepted_count=$invitation->inviteesAccepted()->count();
        $invitation->invitees_rejected_count=$invitation->inviteesRejected()->count();

        $dataInvitation = new InvitationResource($invitation);

        //// checkout
        if($total != 0){
            if (str_starts_with($invitation->user->phone , '00') ) {
                $phone = substr($invitation->user->phone, 2);
            } else if(str_starts_with($invitation->user->phone , '+')){
                $phone = substr($invitation->user->phone, 1);
            } else {
                $phone = $invitation->user->phone ;
            }
            $order_data=[
                'invitation_id'=> $invitation->id ,
                'package_id'=> $package->id ,
                'user_id'=> $user_id ,
                'payment_method_id '=> $request->payment_method_id ,
                'coupon_id'=> @$invitation->coupon_id ,
                'total'=> $invitation->total ,
                'status'=> 0 ,
                'phone'=> $phone ,
            ];

            //order checkout
            $order = Order::create($order_data);
            $response = $this->checkout($order->id,$request->payment_method_id);

            $invitationData = $dataInvitation->toArray(request());

            // Add additional data
            $additionalData = [
                'orderID' => $response['orderID'],
                'url' => $response['URL'],
            ];
            // Merge the additional data with the parent data
            $dataInvitation = array_merge($invitationData, $additionalData);
        }


        $msg = __('lang.done');
        return sendResponse($msg, $dataInvitation);
    }

    public function createInviteesList($count_invitations,$invitation_id){

        for ($i = 0; $i < $count_invitations; $i++) {

            $invited = $this->inviteesRepo->create([
                'invitation_id' => $invitation_id ,
                'title' => "",
                'name' => "",
                'phone' => "",
                'companions_number' => 1 ,
                'link' => "",
                'status' => 'waiting',
            ]);

            $serial_number = $invitation_id."-".$invited->id;
            $this->inviteesRepo->update(['serial_number'=>$serial_number ],$invited->id);

        }

    }

    public function generateQrcode($latitude,$longitude,$qrcodeSize){

        $locationData = $latitude.','.$longitude;
        $link = 'https://www.google.com/maps?q='.$locationData;
        $nameFile = time().'.png';
        $path = storage_path('/app/public/images/'.$nameFile);

        QrCode::format('png')->size($qrcodeSize)->generate($link,$path);
        return $nameFile;
    }

    public function generateImage($image ,$qrcode,$position_qr ,$position_logo ,$is_logo ,$method_type){

        $imgUpload = uploader($image,'images');
        $nameFile = explode('/', $imgUpload)[3];

        $path_qrcode = storage_path('/app/public/images/'.$qrcode);
        $path_img = storage_path('/app/public/images/'.$nameFile);

        $imagePath = Image::make($path_img);
        $qrcodePath = Image::make($path_qrcode);

        if($is_logo == 'yes'){
            $path_logo = public_path('/app_img/logo-3.png');
            $logoPath = Image::make($path_logo);
            $imageWidth = $imagePath->width();
            $logoSize = round(20 * $imageWidth / 100);
            $logoPath->resize($logoSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $imagePath->insert($logoPath, $position_logo, 3, 3);
        }
            $imagePath->insert($qrcodePath, $position_qr, 20, 20);

        // Save the new image with the qr
        $imagePath->save($path_img);
        return $path_img;

    }

    public function show ($id){

        $invitation = $this->invitationRepo->find($id);
//                dd($invitation->withCount('inviteesWaiting')->get());

        $invitation->invitees_waiting_count=$invitation->inviteesWaiting()->count();
        $invitation->invitees_attendees_count=$invitation->inviteesAttendees()->count();
        $invitation->invitees_accepted_count=$invitation->inviteesAccepted()->count();
        $invitation->invitees_rejected_count=$invitation->inviteesRejected()->count();
        $msg = __('lang.done');
        return sendResponse($msg, new InvitationResource($invitation));

    }

    public function types(){

        $data = InvitationType::query()->get();
        $msg = __('lang.done');

        return sendResponse($msg,InvitationTypeResource::collection($data));
    }

    public function checkCode(Request $request){
       $request->validate([
            'code'    => 'required',
        ]);

        $coupon =$this->couponRepo->where('code', $request->code)->first();
        $today  = date('Y-m-d');
        $check = check_promocode($coupon , $today);
        if($check['status'] == 0){
            return sendError( $check['message'] , []);
        }else{

            $msg = __('lang.coupon_active');
            return sendResponse($msg ,new CouponResource($coupon) );
        }

    }

    public function additionalPackage(Request $request){
        $user_id= Auth::user()->id;
        $request->validate([
            'invitation_id'    => 'required',
            'package_id'    => 'required',
            'payment_method_id'    => 'required',
        ]);
        $package =$this->packageRepo->find($request->package_id);
        $invitation = $this->invitationRepo->find($request->invitation_id);

        $package_data=[
            'invitation_id'=> $invitation->id ,
            'package_id'=> $package->id ,
            'invitations_num'=>$package->num_invitations ,
        ];
        AdditionalPackage::create($package_data);


        $additional_package_price =$package->price;
        $total = $invitation->total + $additional_package_price;


//        $data['additional_package_price']=$additional_package_price;
        $data['total']=$total;


        $this->invitationRepo->update($data ,$request->invitation_id);

        if($package->price != 0) {
            if (str_starts_with($invitation->user->phone, '00')) {
                $phone = substr($invitation->user->phone, 2);
            } else if (str_starts_with($invitation->user->phone, '+')) {
                $phone = substr($invitation->user->phone, 1);
            } else {
                $phone = $invitation->user->phone;
            }
            $order_data = [
                'invitation_id' => $invitation->id,
                'package_id' => $package->id,
                'user_id' => $user_id,
                'payment_method_id ' => $request->payment_method_id,
                'coupon_id' => @$invitation->coupon_id,
                'total' => $additional_package_price,
                'status' => 0,
                'phone' => $phone,
            ];

            //order checkout
            $order = Order::create($order_data);
            $response = $this->checkout($order->id, $request->payment_method_id);
            $paymentData = [
                'orderID' => $response['orderID'],
                'url' => $response['URL'],
            ];
            }else{
            $paymentData = [];
        }

        $msg = __('lang.done');

        return sendResponse($msg, $paymentData);

    }

    public function startSend($id){

        SendInvitations::dispatch($id);

//        SendInvitations::dispatch()->delay(now()->addSeconds(30));
        $msg = __('lang.start_send');
        return sendResponse($msg, []);
    }

    public function stopSend($id){
        $msg = __('lang.stop_send');
        return sendResponse($msg, []);
    }




}
