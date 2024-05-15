<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutAsResource;
use App\Models\AboutAs;
use Illuminate\Http\Request;

class AboutAsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = AboutAs::all();
        $msg = __('lang.done');
        return sendResponse( $msg, AboutAsResource::collection($data));
    }
}
