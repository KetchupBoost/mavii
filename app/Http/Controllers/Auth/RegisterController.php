<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Address;
use App\State;
use App\Day;
use App\Hour;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'cpf' => $data['cpf'],
            'cnpj' => $data['cnpj'],
            'password' => Hash::make($data['password']),
            'slug' => Str::slug($data['name'], '-'),
        ]);

        $user->save();

        $address = new Address([
            'postal_code' => only_numbers($data['postal_code']),
            'public_place' => $data['public_place'],
            'street_number' => $data['street_number'],
            'neighborhood' => $data['neighborhood'],
            'complement' => $data['complement'],
            'city_id' => $data['city_id'],
            'slug' => Str::slug($data['postal_code'].' '.$data['street_number'], '-')
        ]);

        $user->address()->save($address);

        $days = [
            ['name' => 'Segunda-feira', 'week_day_number' => 1, 'slug' => 'segunda-feira', 'user_id' => $user->id],
            ['name' => 'Terça-feira', 'week_day_number' => 2, 'slug' => 'terca-feira', 'user_id' => $user->id],
            ['name' => 'Quarta-feira', 'week_day_number' => 3, 'slug' => 'quarta-feira', 'user_id' => $user->id],
            ['name' => 'Quinta-feira', 'week_day_number' => 4, 'slug' => 'quinta-feira', 'user_id' => $user->id],
            ['name' => 'Sexta-feira', 'week_day_number' => 5, 'slug' => 'sexta-feira', 'user_id' => $user->id],
            ['name' => 'Sábado', 'week_day_number' => 6, 'slug' => 'sabado', 'user_id' => $user->id],
            ['name' => 'Domingo', 'week_day_number' => 0, 'slug' => 'domingo', 'user_id' => $user->id]
        ];

        $hours = [
            ['hour' => '00:00'], ['hour' => '00:30'],
            ['hour' => '01:00'], ['hour' => '01:30'],
            ['hour' => '02:00'], ['hour' => '02:30'],
            ['hour' => '03:00'], ['hour' => '03:30'],
            ['hour' => '04:00'], ['hour' => '04:30'],
            ['hour' => '05:00'], ['hour' => '05:30'],
            ['hour' => '06:00'], ['hour' => '06:30'],
            ['hour' => '07:00'], ['hour' => '07:30'],
            ['hour' => '08:00'], ['hour' => '08:30'],
            ['hour' => '09:00'], ['hour' => '09:30'],
            ['hour' => '10:00'], ['hour' => '10:30'],
            ['hour' => '11:00'], ['hour' => '11:30'],
            ['hour' => '12:00'], ['hour' => '12:30'],
            ['hour' => '13:00'], ['hour' => '13:30'],
            ['hour' => '14:00'], ['hour' => '14:30'],
            ['hour' => '15:00'], ['hour' => '15:30'],
            ['hour' => '16:00'], ['hour' => '16:30'],
            ['hour' => '17:00'], ['hour' => '17:30'],
            ['hour' => '18:00'], ['hour' => '18:30'],
            ['hour' => '19:00'], ['hour' => '19:30'],
            ['hour' => '20:00'], ['hour' => '20:30'],
            ['hour' => '21:00'], ['hour' => '21:30'],
            ['hour' => '22:00'], ['hour' => '22:30'],
            ['hour' => '23:00'], ['hour' => '23:30']
        ];

        foreach ($days as $key => $dayRow) {
            $allHours = [];
            $day = new Day($dayRow);

            $day->save();

            foreach ($hours as $key => $hour) {
                $hour = new Hour(['day_id' => $day->id] + $hour);

                $allHours[] = $hour->attributesToArray();
            }

            $hour->insert($allHours);
        }

        $user->assignRole($data['role']);

        return $user;
    }

    /**
    * Show the application registration form.
    *
    * @return \Illuminate\Http\Response
    */
    public function showRegistrationForm()
    {
        if (!Auth::check()) {
            $states = State::all();
            return view('auth.register', ['title' => 'Criar uma Conta', 'states' => $states]);
        } else {
            return redirect()->route('/');
        }
    }
}
