<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;

use App\Day;
use App\Hour;
use App\Event;

class DaysController extends Controller
{
	public function index()
	{
		$days = Day::where('user_id', auth()->user()->id)->get();

		return view('days.index', ['title' => 'Horários', 'days' => $days]);
	}

	// Custom methods

  public function update_status(Request $request, $id)
  {
    $day = Day::find($id);
    $status = str_replace('"', '', $request->get('status'));

    $day->status = $status;
    $day->save();

    return response()->json(['message' => 'Dia alterado com sucesso.']);
  }

  public function hours(Request $request)
  {
    $date = $request->get('start_date');
    $weekDayNumber = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->dayOfWeek;

    $hours = Hour::select(DB::raw('DATE_FORMAT(hours.hour, "%H:%i") as hour, hours.status'))
                    ->join('days', 'days.id', '=', 'hours.day_id')
                    ->where([
                        ['days.user_id', '=', $request->get('user_id')],
                        ['days.week_day_number', '=', $weekDayNumber]
                    ])->get();

    $events = Event::where([
                            ['start_date', '>=', \Carbon\Carbon::now()->format('Y-m-d')],
                            ['professional_id', '=', $request->get('user_id')]
                          ])
                          ->get();

    foreach ($hours as $key => $hour) {
      $formatedHour = \Carbon\Carbon::createFromFormat('H:i', $hour->hour)->format('H:i:s');

      foreach ($events as $eventKey => $event) {
        if ($date == $event->start_date && ($formatedHour >= $event->start_hour && $formatedHour <= $event->end_hour)) {
          Arr::forget($hours, $key);
        }
      }
    }

    return response()->json($hours);
  }
}
