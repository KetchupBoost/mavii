<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Event;

class EventsController extends Controller
{
  public function __construct()
  {
    $this->middleware(['permission:visualizar evento|criar evento|editar evento|apagar evento'], ['only' => ['index']]);
    $this->middleware(['can:criar evento'], ['only' => ['create', 'store']]);
    $this->middleware(['can:editar evento'], ['only' => ['edit', 'update']]);
    $this->middleware(['can:apagar evento'], ['only' => ['destroy']]);
  }
  
  public function index()
  {
    $events = Event::paginate(10);
    return view('admin.events.index', ['title' => 'Eventos', 'events' => $events]);
  }

  public function show($slug)
  {
    return view('admin.events.show', ['event' => Event::where('slug', $slug)->first()]);
  }
}
