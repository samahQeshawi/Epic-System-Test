<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ,
            'name' => $this->name ,
            'date_time' => $this->date_time ,
            'image' => $this->image ,
            'details' => $this->details ,
            'Qrcode' => $this->Qrcode ,
            'invitation_method_type' => $this->method_type ,
            'num_invitations' => $this->num_invitations ,
            'num_invitations_remaining' => $this->remaining_num ,
            'remaining_days' => (string)$this->remaining_days ,
            'num_waiting' => $this->invitees_waiting_count == null ? 0 : $this->invitees_waiting_count,
            'num_attendees' => $this->invitees_attendees_count == null ? 0 :$this->invitees_attendees_count,
            'num_accepted' => $this->invitees_accepted_count == null ? 0 :$this->invitees_accepted_count,
            'num_rejected' => $this->invitees_rejected_count == null ? 0 :$this->invitees_rejected_count,
            'status' => $this->status() ,

        ];
    }
}
