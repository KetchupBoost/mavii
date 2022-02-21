<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\EventLog;

class EventLogsController extends Controller
{
  public function index($event_id)
  {
    $event_logs = EventLog::where('event_id', $event_id)->orderBy('created_at', 'desc')->get();
    return view('event_logs.index', ['event_logs' => $event_logs]);
  }
}
