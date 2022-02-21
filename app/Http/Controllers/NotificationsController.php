<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notification;

class NotificationsController extends Controller
{
  public function index()
	{
		$notifications = Notification::where(['status' => 0, 'user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
    $old_notifications = Notification::where(['status' => 1, 'user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->paginate(10);
		return view('notifications.index', ['title' => 'Notificações', 'notifications' => $notifications, 'old_notifications' => $old_notifications]);
	}

	public function show($slug)
  {
  	$notification = Notification::where('slug', $slug)->first();
  	$notification->status = 1;
  	$notification->save();
  	return view('notifications.show', ['title' => $notification->title, 'notification' => $notification]);
  }
}
