<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\EventLog;
use App\Http\Resources\EventLogCollection as EventLogResource;

class EventLogsController extends Controller
{
  public function index($event_id)
  {
    $event_logs = EventLog::where('event_id', $event_id)->orderBy('created_at', 'desc')->get();
    return new EventLogResource($event_logs);
  }
}
