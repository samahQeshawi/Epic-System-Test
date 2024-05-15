<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
           return [
                'place_address'    => 'required',
                'governorate'    => 'required',
                'region'    => 'required',
                'widget'    => 'required',
                'neighborhood'    => 'required',
                'build_number'    => 'required',
                'floor'    => 'required',
                'lat'    => 'required',
                'long'    => 'required',
            ];

    }
}
