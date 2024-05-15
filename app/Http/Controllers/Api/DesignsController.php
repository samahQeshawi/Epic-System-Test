<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\DesignResource;
use App\Models\Design;
use Illuminate\Http\Request;

class DesignsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Design::all();
        $msg = __('lang.done');
        return sendResponse($msg,DesignResource::collection($data));
    }
}
