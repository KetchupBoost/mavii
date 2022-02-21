<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\EventAccepted;

use App\EventApplication;
use App\Event;
use App\EventLog;
use App\User;
use App\Notification;

class EventApplicationsController extends Controller
{
  public function update(Request $request, $id)
  {
    $request->validate([
      'price' => 'required'
    ]);

    $price = str_replace(',', '.', str_replace('.', '', $request->get('price')));

    $event_application = EventApplication::find($id);

    $event_application->status = '1';

    $event = Event::find($event_application->event_id);

    $event->price = $price;
    $event->status = '2';

    $event->save();

    $event_log = new EventLog([
      'description' => auth()->user()->display_name.' aceitou participar do evento e cobrou: R$ '.$price,
      'event_id' => $event_application->event->id
    ]);

    $event_log->save();

    $notification = new Notification([
      'title' => auth()->user()->display_name.' aceitou participar do seu Evento',
      'description' => auth()->user()->display_name.' aceitou participar do evento '.$event_application->event->name,
      'slug' => Str::slug(\Carbon\Carbon::now().' '.auth()->user()->display_name.' aceitou participar do seu Evento', '-'),
      'user_id' => $event_application->event->user_id
    ]);

    $notification->save();

    $user = User::find($event_application->event->user_id);

    // Mail::to($user->email)->send(new EventAccepted($event_application->event));
    return response()->json(['message' => 'Inscrição realizada com sucesso.']);
  }

  public function approve(Request $request, $id)
  {
    $request->validate([
      'status' => 'required'
    ]);

    $event_application = EventApplication::find($id);

    $event_application->status = '2';

    $event = Event::find($event_application->event_id);

    if ($event_application->status == '3') {
      $event->price = NULL;
      $event->professional_id = NULL;
      $event->status = '4';
    } else {
      $event->status = '5';
    }

    $event->save();

    if ($event_application->status == '2') {
      $event_log = new EventLog([
        'description' => auth()->user()->name.' aprovou o valor cobrado.',
        'event_id' => $event_application->event->id
      ]);

      $event_log->save();

      $notification = new Notification([
        'title' => auth()->user()->name.' aprovou o valor cobrado',
        'description' => auth()->user()->name.' aprovou o valor cobrado e te aguarda no dia do evento.',
        'slug' => Str::slug(\Carbon\Carbon::now().' '.auth()->user()->name.' aprovou o valor cobrado', '-'),
        'user_id' => $event_application->event->professional_id
      ]);

      $notification->save();
    } else {
      $event_log = new EventLog([
        'description' => auth()->user()->name.' recusou o valor cobrado.',
        'event_id' => $event_application->event->id
      ]);

      $event_log->save();

      $notification = new Notification([
        'title' => auth()->user()->name.' recusou o valor cobrado',
        'description' => auth()->user()->name.' recusou o valor cobrado.',
        'slug' => Str::slug(\Carbon\Carbon::now().' '.auth()->user()->name.' recusou o valor cobrado', '-'),
        'user_id' => $event_application->event->professional_id
      ]);

      $notification->save();
    }

    $proffessional = User::find($event_application->event->professional_id);

    // Mail::to($proffessional->email)->send(new EventAccepted($event_application->event));
    return response()->json(['message' => 'Profissional aprovado com sucesso.']);
  }
}
