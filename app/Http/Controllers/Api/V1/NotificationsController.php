<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notification;
use App\Http\Resources\NotificationCollection as NotificationResource;

class NotificationsController extends Controller
{
	public function index()
	{
		$notifications = Notification::where(['status' => 0, 'user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
		return new NotificationResource($notifications);
	}
}
