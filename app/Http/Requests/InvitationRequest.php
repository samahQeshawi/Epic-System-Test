<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
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
            'package_id'    => 'required',
            'invitation_address_id'    => 'required',
            'invitation_type_id'    => 'required',
            'coupon_id'    => 'nullable',
            'is_notice_before_time'    => 'required|boolean',
            'is_notice_specified_date'    => 'required|boolean',
            'specified_date'    => 'required_if:is_notice_specified_date,1|nullable|date',
            'method_type'    => 'required|in:contacts,numbered',
            'name'    => 'required|string',
            'inviter_name'    => 'required|string',
            'date_time'    => 'required|date_format:Y-m-d H:i',
            'details'    => 'required',
            'Qrcode_place'    => 'required|in:bottom-left,top-left,bottom-right,top-right',
            'image'    => 'required',
            'is_logo_remove'    => 'required|boolean',
//            'payment_method_id'    => 'required',
        ];
    }
}
