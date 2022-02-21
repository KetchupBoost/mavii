<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use Auth;

use App\Mail\EventCreated;

use App\EventCategory;
use App\EventApplication;
use App\EventLog;
use App\Notification;
use App\User;
use App\Event;

class EventsController extends Controller
{
	/**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
		parent::__construct();
  }

	public function index()
	{
		if (auth()->user()->hasRole('profissional')) {
			$events = Event::where('professional_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
		} else {
			$events = Event::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
		}

		return view('events.index', ['title' => 'Eventos', 'events' => $events]);
	}

	public function create()
  {
  	$event_categories = EventCategory::all();
    return view('events.create', ['title' => 'Contratar', 'event_categories' => $event_categories]);
  }

  public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'start_date' => 'required',
			'start_hour' => 'required|date_format:H:i',
			'location' => 'required',
			'lat' => 'required',
			'lng' => 'required',
			'event_category_id' => 'required'
		]);

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
			'user_id' => Auth::id()
		]);

		$event->save();

		if ($request->get('professional_id')) {
			$event_application = new EventApplication([
				'status' => '0',
	  		'user_id' => $request->get('professional_id')
	    ]);

	    $event->event_applications()->save($event_application);

	    $notification = new Notification([
	  		'title' => 'Convite de Novo Evento',
	  		'description' => Auth::user()->name.' te convidou para o '.$request->get('name'),
	  		'link' => route('events.show', $event->slug),
	  		'slug' => Str::slug(\Carbon\Carbon::now().' Convite de Novo Evento', '-'),
	  		'user_id' => $request->get('professional_id')
	    ]);

	    $notification->save();

	    $professional = User::find($request->get('professional_id'));

	    // Mail::to($professional->email)->send(new EventCreated($event));
		}

    $event_log = new EventLog([
			'description' => 'Evento criado.'
    ]);

    $event->event_logs()->save($event_log);

		return redirect()->route('events.index')->with('success', 'Evento criado com sucesso.');
	}

	public function show($slug)
  {
  	$event = Event::where('slug', $slug)->first();
  	return view('events.show', ['title' => $event->name, 'event' => $event]);
  }
}
