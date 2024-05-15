<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Method;
use Illuminate\Http\Request;
use App\Http\Resources\MethodResource;

class MethodsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Method::all();
        $msg = __('lang.done');
        return sendResponse($msg,MethodResource::collection($data));
    }
}
