<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InviteesListResource extends JsonResource
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
            'serial_code' => $this->serial_number ,
            'title' => $this->title,
            'name' => $this->name,
            'companions_number' => (int)$this->companions_number,
            'phone' => (string)$this->phone,
            'status' => $this->status,
            'is_send' => $this->is_send,
            'reason' => $this->reason,
            'link' => $this->link,
        ];
    }
}
