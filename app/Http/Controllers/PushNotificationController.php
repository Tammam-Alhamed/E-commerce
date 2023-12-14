<?php

namespace App\Http\Controllers;

use App\Models\cr;
use Illuminate\Http\Request;
use App\Models\PushNotification;

class PushNotificationController extends Controller
{

    public function index()
    {
        $notifications = PushNotification::orderBy('notification_datetime', 'desc')->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function bulksend(Request $req ){
        // dd(date_default_timezone_get());
        $topic = "users";
        $comment = new PushNotification();
        $comment->notification_title = $req->input('title');
        $comment->notification_body = $req->input('body');
        $comment->notification_body_en = $req->input('body_en');
        $comment->notification_body_ru = $req->input('body_ru');
        $comment->save();
        
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array(
        "to" => '/topics/' . $topic,
        'priority' => 'high',
        'content_available' => true,

        'notification' => array(
            "body" =>  $req->input('body'),
            "title" =>  $req->input('title'),
            "click_action" => "FLUTTER_NOTIFICATION_CLICK",
            "sound" => "default"

        ),
        
          'data' => array(
            "pageid" => "none",
            "pagename" => "refreshorderpending"
        )


    );


    $fields = json_encode($fields);
    $headers = array(
        'Authorization: key=' . "AAAANuTldds:APA91bGqzFjZQ2QmpLoT7wY3QRhLWZuNpfmiqWenQY5WYLEJzQ2mm87gSPmZtlSgifD0c_Y98oj3cJFNHVjxzRKDub-2sXxP8sY6Ki0ayWt96aqXdIr7sZwdqmyOA5NKUcFzJ1YDeQK1",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

    $result = curl_exec($ch);
    return $result;
    curl_close($ch);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {
        return view('admin.notifications.create');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}