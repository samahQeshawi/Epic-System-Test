<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Models\CountryCode;
use Illuminate\Http\Request;
use DB;

class CountriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = CountryCode::orderBy(DB::raw('ISNULL(`order_id`), `order_id`'), 'asc')->get();

        $msg = __('lang.done');
        return sendResponse($msg,CountryResource::collection($data));
    }
}
