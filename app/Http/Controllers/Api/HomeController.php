<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutAsResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\DesignResource;
use App\Http\Resources\PackageResource;
use App\Models\AboutAs;
use App\Models\Banner;
use App\Models\Design;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $banners = Banner::all();
        $designs= Design::all();
        $aboutAs = AboutAs::all();
        $packages = Package::all();
        $unread_notification_count = 0 ;
        if(auth('sanctum')->check()){
            $user =auth('sanctum')->user();

            $unread_notification_count =$user->unreadNotifications()->count();
        }
//        dd($unread_notification_count);
        $data =[
            'unread_notification_count' => $unread_notification_count ,
            'banners' => BannerResource::collection($banners) ,
            'designs' => DesignResource::collection($designs) ,
            'about-us' => AboutAsResource::collection($aboutAs) ,
            'packages' => PackageResource::collection($packages) ,
        ];

        $msg = __('lang.done');
        return sendResponse($msg, $data);
    }
}
