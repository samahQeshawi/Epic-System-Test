<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [] ;
        if(auth('sanctum')->check()){
            $user =auth('sanctum')->user();
            $data =$user->notifications;
            $user->notifications->markAsRead();
        }
        $msg = __('lang.done');
        return sendResponse($msg,NotificationResource::collection($data));
    }

    public function update($notificationId){
        $user =auth('sanctum')->user();

        $notification = $user->notifications()->find($notificationId); // Retrieve a specific notification

        if ($notification) {
            $notification->markAsRead();
        }
        $msg = __('lang.done');
        return sendResponse($msg, new NotificationResource($notification));

    }
}
