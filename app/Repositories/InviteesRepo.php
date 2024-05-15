<?php

namespace App\Repositories;

use App\Models\Invitation;
use App\Models\InviteesList;
use App\Models\Package;

class InviteesRepo extends Repository
{
    protected $model;

    public function __construct(InviteesList $model) {
        $this->model = $model;
    }
    public function getByInvitationId($invitationId) {
        return $this->model->where('invitation_id', $invitationId)->get();
    }

    public function inviteesListByStatus($invitationId,$status) {
        return $this->model->where('invitation_id', $invitationId)
            ->where('status',$status)->get();
    }

    public function BalanceCheck($invitationId){
//        $package_num_invit =  Invitation::find($invitationId)->package->num_invitations ;

        $package_num_invit =  Invitation::find($invitationId)->num_invitations ;
        $use_num_invit = $this->getByInvitationId($invitationId)->count();

        if($use_num_invit >= $package_num_invit){
            return false ;
        }else{
            return true;
        }

    }

    public function remainingBalanceCheck($invitationId,$count_list){

        $invitation = Invitation::find($invitationId);
        $remaining_num_invit = $invitation->remaining_num;

        if($count_list > $remaining_num_invit){
            return false ;
        }else{
            return true;
        }

    }

}
