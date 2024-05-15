<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\NotificationsDataTable;
use App\Http\Controllers\Controller;
//use App\Models\Notification;
use App\Models\Notify;
use Illuminate\Support\Facades\Notification;

use App\Notifications\GeneralNotification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\FireBase;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NotificationsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.notifications.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $notify = Notify::create($data);
//        $this->send($notify);

        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return redirect()->route('notifications.create');

    }


    public function send($id){

        $notify = Notify::find($id);
        $users =User::get();
        Notification::send($users, new GeneralNotification($notify['title'],$notify['body']));

        $tokens =User::pluck('fcm_token')->toArray();
         $data=[
             'title'=> $notify->title,
             'body'=>$notify->body,
         ];
//        Firebase::sendFCMTopic( '/topics/marasim', $request->title,  $request->body, ' ', $is_notification = true);
        Firebase::sendFcm($notify->title, $notify->body,  $tokens, $data);
        $notify->update(['status' => 'active']);
        $msg = 'تم ارسال الاشعار بنجاح';
        alert()->success($msg);
        return redirect()->route('notifications.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notify = Notify::find($id);
        return view('dashboard.notifications.edit',['notify' => $notify]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $notify =  Notify::where('id',$id)->update($data);
        $msg = 'تم حفظ التغييرات';
        alert()->success($msg);
        return  back()->with(['notify' => $notify]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notify::where('id', $id)->delete();
        return redirect()->route('notifications.index');
    }
}
