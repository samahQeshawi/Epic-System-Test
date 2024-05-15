<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\TermResource;
use App\Models\Page;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = Page::where('key','terms')->first();
        $msg = __('lang.done');
        return sendResponse($msg, new TermResource($data));

    }
}
