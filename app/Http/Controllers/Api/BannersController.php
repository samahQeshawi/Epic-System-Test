<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BannerResource;
use App\Models\Banner;

class BannersController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Banner::all();
        $msg = __('lang.done');
        return sendResponse($msg,BannerResource::collection($data));
    }
}
