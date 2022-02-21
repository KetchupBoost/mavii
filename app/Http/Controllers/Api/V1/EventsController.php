<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Mail\EventCreated;

use App\EventCategory;
use App\EventApplication;
use App\EventLog;
use App\Notification;
use App\User;
use App\Event;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;

class EventsController extends Controller
{
	public function index()
	{
		if (auth()->user()->hasRole('profissional')) {
			$events = Event::where('professional_id', auth()->user()->id)->get();
		} else {
			$events = Event::where('user_id', auth()->user()->id)->get();
		}
		
		return new EventCollection($events);
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_date' => 'required',
			'start_hour' => 'required|date_format:H:i',
			'people_amount' => 'required',
			'location' => 'required',
			'lat' => 'required',
			'lng' => 'required',
			'professional_id' => 'required',
			'event_category_id' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors()->first(), 400);
		} else {
			$event = new Event([
				'name' => $request->get('name'),
				'description' => $request->get('description'),
				'start_date' => \Carbon\Carbon::parse(str_replace('/', '-', $request->get('start_date')))->format('Y-m-d'),
				'start_hour' => $request->get('start_hour'),
				'people_amount' => $request->get('people_amount'),
				'location' => $request->get('location'),
				'lat' => $request->get('lat'),
				'lng' => $request->get('lng'),
				'status' => '1',
				'professional_id' => $request->get('professional_id'),
				'slug' => Str::slug($request->get('name').' '.$request->get('start_date'), '-'),
				'event_category_id' => $request->get('event_category_id'),
				'user_id' => auth()->user()->id
			]);

			$event->save();

			$event_application = new EventApplication([
				'status' => '0',
	  		'user_id' => $request->get('professional_id')
	    ]);

	    $event->event_applications()->save($event_application);

	    $event_log = new EventLog([
				'description' => 'Evento criado.'
	    ]);

	    $event->event_logs()->save($event_log);

	    $notification = new Notification([
	  		'title' => 'Convite de Novo Evento',
	  		'description' => auth()->user()->name.' te convidou para o '.$request->get('name'),
	  		'link' => route('events.show', $event->slug),
	  		'slug' => Str::slug(\Carbon\Carbon::now().' Convite de Novo Evento', '-'),
	  		'user_id' => $request->get('professional_id')
	    ]);

	    $notification->save();

	    $professional = User::find($request->get('professional_id'));

	    // Mail::to($professional->email)->send(new EventCreated($event));
			return response()->json('Evento criado com sucesso.');
		}
	}

	public function show($slug)
  {
  	$event = Event::where('slug', $slug)->first();
  	return EventResource($event);
  }
}
