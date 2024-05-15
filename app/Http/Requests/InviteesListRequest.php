<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InviteesListRequest extends FormRequest
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
            'invitation_id'    => 'required',
            'invitees'    => 'required|array',
            'invitees.*.title'    => 'nullable',
            'invitees.*.name'    => 'nullable',
            'invitees.*.phone'    => 'required',
            'invitees.*.companions_number'    => 'nullable',

        ];
//        return [
//            'invitation_id'    => 'required',
//            'title'    => 'array|nullable',
//            'name'    => 'array|nullable',
//            'phone'    => 'array|required',
//            'companions_number'    => 'array|nullable',
//        ];
    }
}
