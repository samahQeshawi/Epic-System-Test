<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScanAddressResource extends JsonResource
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
            'lat' => $this->lat,
            'long' => $this->long,
            'place_address' => $this->place_address,
            'governorate' => $this->governorate,
            'region' => $this->region,
            'widget' => $this->widget,
            'neighborhood' => $this->neighborhood,
            'build_number' => $this->build_number,
            'floor' => $this->floor,
        ];
    }
}
