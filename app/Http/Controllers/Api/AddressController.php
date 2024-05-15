<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\InvitationAddressRepo;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\ScanAddressResource;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $addressRepo;

    public function __construct(InvitationAddressRepo $addressRepo)
    {
        // INITIATE REPOS
        $this->addressRepo = $addressRepo;
    }

    public function store(AddressRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $data['user_id'] =$user->id;
        $address = $this->addressRepo->create($data);
        $msg = __('lang.done');

        return sendResponse($msg,new AddressResource($address));
    }




}
