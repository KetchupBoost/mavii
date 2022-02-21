<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\Contact;

use App\Specialty;
use App\Subspecialty;
use App\User;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!auth()->check()) {
            $specialties = Specialty::where('status', 1)->get();
            $subspecialties = Subspecialty::where('featured', 1)->get();
            $users = User::role('profissional')->where('status', 1)->get();

            if (auth()->check() && auth()->user()->address) {
                foreach ($users as $key => $user) {
                    $userLat = $user->address->lat;
                    $userLng = $user->address->lng;
                    $distance = 5;

                    $result = vincenty_great_circle_distance(auth()->user()->address->lat, auth()->user()->address->lng, $userLat, $userLng);
                    
                    if (floor($result / 1000) > $distance) {
                        $users->forget($key);
                    }
                }
            }
            
            return view('home', ['title' => 'Home', 'specialties' => $specialties, 'subspecialties' => $subspecialties, 'users' => $users]);
        } else {
            $events = Event::where([
                ['status', '=', ['1', '4']]
            ])->get();

            if (auth()->user()->address) {
                foreach ($events as $key => $event) {
                    $eventLat = $event->lat;
                    $eventLng = $event->lng;
                    $distance = 50;

                    $result = vincenty_great_circle_distance(auth()->user()->address->lat, auth()->user()->address->lng, $eventLat, $eventLng);
                    
                    if (floor($result / 1000) > $distance) {
                        $events->forget($key);
                    }
                }
            }

            return view('home_user', ['title' => 'Home', 'events' => $events]);
        }
    }

    public function contact()
    {
        return view('contact', ['title' => 'Contato']);
    }

    public function send_contact(Request $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'cellphone' => $request->get('cellphone'),
            'body' => $request->get('body')
        ];

        Mail::to([$this->info->email1, $this->info->email2])->send(new Contact($data));
        return redirect()->route('contact')->with('success', 'Mensagem enviada com sucesso');
    }

    public function admin()
    {
        if (!auth()->check()) {
            return view('admin', ['title' => 'Painel Administrador']);
        } else {
            return redirect()->route('admin.home');
        }
    }
}
