<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\PackageResource;
use App\Http\Resources\RatingResource;
use App\Models\Package;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rating::query()->where('status','active')->get();
        $msg = __('lang.done');

        return sendResponse($msg,RatingResource::collection($data));
    }

    public function store(Request $request){
        $data =  $request->validate([
            'rate' => 'required|numeric|min:1|max:5',
            'comment' => 'required',
        ]);

        $user = Auth::user();
        $rate = $user->rates()->craete($data);

        $msg = __('lang.done');
        return sendResponse($msg, new RatingResource($rate));

    }
}
