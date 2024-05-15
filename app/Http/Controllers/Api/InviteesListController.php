<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\InviteesRequest;
use App\Http\Requests\InviteesListRequest;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\InviteesListResource;
use App\Models\InviteesList;
use App\Repositories\InvitationAddressRepo;
use App\Repositories\InvitationRepo;
use App\Repositories\InviteesRepo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class InviteesListController extends Controller
{
    private $inviteesRepo;
    private $invitationRepo;
    private $addressRepo;


    public function __construct(InviteesRepo $inviteesRepo ,InvitationRepo $invitationRepo ,InvitationAddressRepo $addressRepo)
    {
        // INITIATE REPOS
        $this->inviteesRepo = $inviteesRepo;
        $this->invitationRepo = $invitationRepo;
        $this->addressRepo = $addressRepo;

    }

    public function show($id){
        $data = $this->inviteesRepo->getByInvitationId($id);
        $msg = __('lang.done');
        return sendResponse($msg,InviteesListResource::collection($data));
    }

    public function showListByStatus($id,$status){
        $data = $this->inviteesRepo->inviteesListByStatus($id,$status);
        $msg = __('lang.done');
        return sendResponse($msg,InviteesListResource::collection($data));
    }

    public function store(InviteesRequest $request)
    {
        $data = $request->validated();

         $check_balance = $this->inviteesRepo->BalanceCheck($data['invitation_id']);

         if($check_balance == false){
             $msg = __('lang.balance_not_enough');
             return sendError( $msg , []);
         }
        $data['link']= rand(9999,10000) ;
        $data['status']= 'waiting';
        $list = $this->inviteesRepo->create($data);

        $link = \URL::signedRoute('share-link', $list->id);
//        $link = \URL::signedRoute('share-link', ['user' => $list->id]);

        $list ->link =$link;
        $list->save();

        $msg = __('lang.done');
        return sendResponse($msg,new InviteesListResource($list));

    }

    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'title'    => 'nullable',
            'name'    => 'nullable',
            'phone'    => 'nullable',
            'companions_number'    => 'nullable',
        ]);

        $data['link'] = \URL::signedRoute('share-link', $id);

        $list = $this->inviteesRepo->update($data , $id);

        $msg = __('lang.edit_done');
        return sendResponse($msg,new InviteesListResource($list));

    }

    public function delete($id)
    {
        $this->inviteesRepo->destroy($id);
        $msg = __('lang.delete_done');
        return sendResponse($msg,[]);

    }

    public function scanQrcode($id)
    {
        $invitee_id = InviteesList::find($id);
        if(! $invitee_id){
            $msg = __('lang.not_found');
            return sendError( $msg , [] ,404);
        }
        $user = $this->inviteesRepo->update(['status' => 'complete'] , $id);
        $msg = __('lang.done');
           return sendResponse($msg,new InviteesListResource($user));

    }

    public function shareLink($id){
        $invitees= $this->inviteesRepo->find($id);
        $message_whatsapp ='اهلا  بك في تطبيق يباب 😀'. '\n' . 'رابط الدعوة هو ' . '\n' . $invitees->link ;
//        whatsapp($invitees->phone, $message_whatsapp);

        $msg = __('lang.done');
        return sendResponse($msg,[]);

    }

    public function addAllInvitees(InviteesListRequest $request){

        $data = $request->validated();

        $count_invitees = count($data['invitees']);

        $check_balance = $this->inviteesRepo->remainingBalanceCheck($data['invitation_id'],$count_invitees);

        if($check_balance == false){
            $msg = __('lang.balance_not_enough');
            return sendError( $msg , []);
        }

        foreach ($data['invitees'] as $invitee) {
            $invited = $this->inviteesRepo->create([
                'invitation_id' => $data['invitation_id'],
                'title' => $invitee['title'],
                'name' => $invitee['name'],
                'phone' => $invitee['phone'],
                'companions_number' => $invitee['companions_number'],
                'link' => rand(9999,10000),
                'status' => 'waiting',
            ]);

            $link = \URL::signedRoute('share-link', $invited->id);
            $invited ->link =$link;
            $invited->save();

        }

        $inviteesList = $this->inviteesRepo->getByInvitationId($data['invitation_id']);

        $msg = __('lang.done');
        return sendResponse($msg,InviteesListResource::collection($inviteesList));
    }

    public function updateNumberedInvitation(Request $request,$id){

        $data = $request->validate([
            'name'    => 'required',
        ]);
        $invited = $this->inviteesRepo->find($id);

        $image =$invited->invitation->image;
        $this->generateNameToImage($image,$request->name);
        $data['link'] = $image;
        $list = $this->inviteesRepo->update($data , $id);

        $msg = __('lang.edit_done');
        return sendResponse($msg,new InviteesListResource($list));
    }

    public function generateNameToImage($image , $name){

        $pathinfo = pathinfo($image);

        $path_img = storage_path('/app/public/images/'.$pathinfo['basename']);

        $imagePath = Image::make($path_img);

        $imagePath->text($name, 10, 10, function($font) {
//            $font->file(public_path('_dashboard/fonts/font.ttf'));
            $font->size(32);
            $font->color('#FFFFFF');
//            $font->align('center');
//            $font->valign('bottom');
//            $font->angle(90);
        });
        // Save the new image with the qr
        $imagePath->save($path_img);
        return $path_img;
    }

    public function updateStatus($id){

        $invited = $this->inviteesRepo->update(['is_send' => 1] , $id);

        $msg = __('lang.edit_done');
        return sendResponse($msg,new InviteesListResource($invited));
    }

}
