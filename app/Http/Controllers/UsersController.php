<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

use DB;

use App\User;
use App\Subspecialty;
use App\UserSubspecialty;
use App\State;
use App\Address;

class UsersController extends Controller
{
	public function __construct()
  {
  	parent::__construct();
  	$this->middleware(['role:profissional'], ['only' => ['edit_profile', 'update_profile']]);
  }

  public function index(Request $request)
	{
		$subspecialties = Subspecialty::where('status', 1)->get();

		if (!$request->get('keyword')) {
			$users = User::role('profissional')
										->where('status', 1)
										->paginate(10);
		} else {
			$users = User::select('users.*')
												->role('profissional')
												->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
												->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
												->where([
													['users.status', '=', 1],
													['users.display_name', 'LIKE', '%'.$request->get('keyword').'%'],
												])
												->orWhere([
													['users.status', '=', 1],
													['subspecialties.name', 'LIKE', '%'.$request->get('keyword').'%']
												])
												->groupBy('users.id')
												->get();
		}

		return view('users.index', ['title' => 'Profissionais', 'users' => $users, 'subspecialties' => $subspecialties]);
	}

	public function edit()
	{
		$user = auth()->user();
		$states = State::all();
		
		return view('users.edit', ['title' => 'Dados Pessoais', 'user' => $user, 'states' => $states]);
	}

	public function update(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = User::find(auth()->user()->id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		if ($request->get('password')) {
			$user->password = bcrypt($request->get('password'));	
		}
		$user->phone = only_numbers($request->get('phone'));
		$user->cellphone = only_numbers($request->get('cellphone'));
		$user->birthdate = \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d');
		$user->gender = $request->get('gender');
		$user->type = $request->get('type');
		$user->cpf = only_numbers($request->get('cpf'));
		$user->cnpj = only_numbers($request->get('cnpj'));
		$user->company_name = $request->get('company_name');

		if ($request->hasFile('avatar')) {
			Storage::delete($request->get('current_file'));
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}

		$user->slug = Str::slug($request->get('name'), '-');
		$user->save();

		if (!$user->address) {
			$address = new Address();
		} else {
			$address = Address::find($user->address->id);
		}

		$address->postal_code = only_numbers($request->get('postal_code'));
		$address->public_place = $request->get('public_place');
		$address->street_number = $request->get('street_number');
		$address->neighborhood = $request->get('neighborhood');
		$address->city_id = $request->get('city_id');
		$address->complement = $request->get('complement');
		$address->lat = $request->get('lat');
		$address->lng = $request->get('lng');
		$address->slug = Str::slug($request->get('postal_code').' '.$request->get('street_number'), '-');

		$user->address()->save($address);

		return redirect()->route('users.edit')->with('success', 'Usuário salvo com sucesso');
	}

	public function show($slug)
  {
  	$user = User::where('slug', $slug)->first();
  	return view('users.show', ['title' => !$user->display_name ? $user->name : $user->display_name, 'user' => $user]);
  }

	// Change password

	public function edit_password()
	{
		$user = auth()->user();
		return view('users.edit_password', ['title' => 'Alterar Senha', 'user' => $user]);
	}

	public function update_password(Request $request)
	{
		$request->validate([
			'password' => ['required', 'string', 'min:8', 'confirmed']
		]);

		$user = User::find(auth()->user()->id);

		$user->password = bcrypt($request->get('password'));
		$user->save();

		return redirect()->route('users.edit_password')->with('success', 'Senha alterada com sucesso');
	}

	public function edit_profile()
	{
		$user = auth()->user();
		$subspecialties = Subspecialty::all();
		$user_subspecialties = UserSubspecialty::where('user_id', $user->id)->pluck('subspecialty_id');

		return view('users.edit_profile', ['title' => 'Perfil', 'user' => $user, 'subspecialties' => $subspecialties, 'user_subspecialties' => $user_subspecialties->toArray()]);
	}

	public function update_profile(Request $request)
	{
		$request->validate([
			'display_name' => 'required',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = User::find(auth()->user()->id);

		$user->display_name = $request->get('display_name');
		$user->bio = $request->get('bio');
		$user->status = !$request->get('status') ? 0 : $request->get('status');
		if ($request->hasFile('avatar')) {
			Storage::delete($request->get('current_file'));
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}
		$user->save();

		$allUserSubspecialties = [];
		$subspecialties = !$request->get('subspecialties') ? [] : $request->get('subspecialties');
		$currentSubspecialties = !$request->get('current_subspecialties') ? [] : explode(',', $request->get('current_subspecialties'));

		if (count($subspecialties) > count($currentSubspecialties)) {
			$subspecialtiesToAdd = array_diff($subspecialties, $currentSubspecialties);
		} elseif(count($subspecialties) < count($currentSubspecialties)) {
			$subspecialtiesToRemove = array_diff($currentSubspecialties, $subspecialties);
		} else {
			if ($currentSubspecialties || $subspecialties) {
				$subspecialtiesToRemove = array_diff($currentSubspecialties, $subspecialties);
				$subspecialtiesToAdd = array_diff($subspecialties, $currentSubspecialties);
			}
		}

		if (@$subspecialtiesToAdd) {
			foreach ($subspecialtiesToAdd as $key => $subspecialty) {
				$user_subspecialty = new UserSubspecialty([
					'subspecialty_id' => $subspecialty,
					'user_id' => $user->id
				]);

				$allUserSubspecialties[] = $user_subspecialty->attributesToArray();
			}

			$user_subspecialty->insert($allUserSubspecialties);
		}

		if (@$subspecialtiesToRemove) {
			foreach ($subspecialtiesToRemove as $key => $subspecialty) {
				$user_subspecialty = UserSubspecialty::where([
																								['subspecialty_id', '=', $subspecialty],
																								['user_id', '=', $user->id]
																							])->first();
				$user_subspecialty->delete();
			}
		}

		return redirect()->route('users.edit_profile')->with('success', 'Perfil atualizado com sucesso');
	}

	public function second_step_register()
	{
		if (auth()->user()->roles) {
			return redirect()->route('home');
		}

		$user = auth()->user();
		$states = State::all();

		return view('users.second_step_register', ['title' => 'Atualizar Cadastro', 'user' => $user, 'states' => $states]);
	}

	public function update_second_step_register(Request $request)
	{
		$request->validate([
			'city_id' => 'required'
		]);

		$user = User::find(auth()->user()->id);
		$user->type = $request->get('type');
		$user->cpf = only_numbers($request->get('cpf'));
		$user->cnpj = only_numbers($request->get('cnpj'));
		$user->company_name = only_numbers($request->get('company_name'));

		$user->save();

		$address = new Address([
			'postal_code' => only_numbers($request->get('postal_code')),
			'public_place' => $request->get('public_place'),
			'street_number' => $request->get('street_number'),
			'neighborhood' => $request->get('neighborhood'),
			'complement' => $request->get('complement'),
			'city_id' => $request->get('city_id'),
			'slug' => Str::slug($request->get('postal_code').' '.$request->get('street_number'), '-')
		]);

		$user->address()->save($address);
		$user->assignRole($request->get('role'));

		return redirect()->route('home')->with('success', 'Cadastro atualizado com sucesso.');
	}

	public function filter(Request $request)
	{
		$lat = $request->get('lat');
		$lng = $request->get('lng');

		$subspecialties = Subspecialty::where('status', 1)->get();

		if (!$request->get('subspecialties')) {
			$users = User::select('users.*')
									->role('profissional')
									->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
									->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
									->where([
										['users.status', '=', 1],
										['users.display_name', 'LIKE', '%'.$request->get('keyword').'%'],
									])
									->groupBy('users.id')
									->get();
		} else {
			$users = User::select('users.*')
									->role('profissional')
									->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
									->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
									->where([
										['users.status', '=', 1],
										['users.display_name', 'LIKE', '%'.$request->get('keyword').'%'],
									])
									->WhereIn('user_subspecialties.subspecialty_id', $request->get('subspecialties'))
									->groupBy('users.id')
									->get();
		}

		if ($lat && $lng) {
			foreach ($users as $key => $user) {
				$userLat = $user->address->lat;
				$userLng = $user->address->lng;
				$distance = (float)$request->get('distance');

				$result = vincenty_great_circle_distance($lat, $lng, $userLat, $userLng);
				
				if (floor($result / 1000) > $distance) {
					$users->forget($key);
				}
			}
		}

		$html = view('users._list', ['users' => $users, 'subspecialties' => $subspecialties])->render();

		return response()->json(['html' => $html], 200);
	}
}
