<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Address;
use App\Subspecialty;
use App\UserSubspecialty;
use App\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'unique:users'
		], [
			'email.unique' => 'Já existe uma conta criada com este endereço de Email.'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors()->first(), 400);
		} else {
			try {
				$user = new User([
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'password' => bcrypt($request->get('password')),
					'status' => 1,
					'slug' => 'slug'
				]);

				if ($user->save()) {
					$user->update([
		        'slug' => Str::slug($user->id . ' ' .$request->get('name'), '-')
		      ]);
				
					return new UserResource($user);
				}
			} catch(\Exception $e) {
				if ($e->errorInfo[0] == '23000') {
					$user = User::where('email', $request->get('email'))->first();
					return new UserResource($user);
				} else {
					return response()->json($e->getMessage(), 401);
				}
			}
		}
	}

	public function show($slug)
  {
  	$user = User::where('slug', $slug)->first();

  	if ($user->hasRole(['cliente', 'profissional'])) {
			$user->role = $user->roles->pluck('name')->first();
		}

  	return new UserResource($user);
  }

	// Custom methods

	public function account(Request $request)
	{
		$user = User::find(auth()->user()->id);
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->type = $request->get('type');
		$user->cpf = only_numbers($request->get('cpf'));
		$user->cnpj = only_numbers($request->get('cnpj'));
		$user->company_name = only_numbers($request->get('company_name'));
		$user->phone = only_numbers($request->get('phone'));
		$user->cellphone = only_numbers($request->get('cellphone'));
		$user->birthdate = $request->get('birthdate') == 'Invalid date' ? null : $request->get('birthdate');
		$user->gender = $request->get('gender');
		$user->bio = $request->get('bio');

		if ($user->save()) {
			if ($user->hasRole(['cliente', 'profissional'])) {
				$user->role = $user->roles->pluck('name')->first();
			}
			
			return new UserResource($user);
		}
	}

	public function update_profile(Request $request)
	{
		$request->validate([
			'display_name' => 'required'
		]);

		$user = User::find(auth()->user()->id);

		$user->display_name = $request->get('display_name');
		$user->bio = $request->get('bio');
		$user->status = !$request->get('status') ? 0 : $request->get('status');

		if ($user->save()) {
			if ($user->hasRole(['cliente', 'profissional'])) {
				$user->role = $user->roles->pluck('name')->first();
			}
			
			return new UserResource($user);
		}
	}

	public function edit_subspecialties()
	{
		$user = User::find(auth()->user()->id);
		$subspecialties = Subspecialty::orderBy('name')->get();
		$user_subspecialties = UserSubspecialty::where('user_id', $user->id)->pluck('subspecialty_id');

		return response()->json(['subspecialties' => $subspecialties, 'user_subspecialties' => $user_subspecialties->toArray()]);
	}

	public function update_subspecialties(Request $request)
	{
		$request->validate([
			'subspecialties' => 'required'
		]);

		$user = User::find(auth()->user()->id);

		$allUserSubspecialties = [];
		$subspecialties = !$request->get('subspecialties') ? [] : $request->get('subspecialties');
		$currentSubspecialties = !$request->get('current_subspecialties') ? [] : $request->get('current_subspecialties');

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

		return response()->json(['success' => 'Subespecialidades alteradas com sucesso']);
	}

	public function change_avatar(Request $request)
	{
		$request->validate([
			'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = auth()->user();

		if ($request->hasFile('avatar')) {
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}

		if ($user->save()) {
			if ($user->hasRole(['cliente', 'profissional'])) {
				$user->role = $user->roles->pluck('name')->first();
			}
			
			return response()->json(['success' => new UserResource($user)]);
		} else {
			return response()->json(['error' => 'Unauthorised'], 401);
		}
	}

	public function login(Request $request) {
		$credentials = [
			'email' => $request->get('email'),
			'password' => $request->get('password')
		];

		if(auth()->attempt($credentials)) {
			$user = User::find(auth()->user()->id);

			if (!$user->status) {
				return response()->json('Login inválido.', 400);
			} else {
				if ($user->hasRole(['cliente', 'profissional'])) {
					$user->role = $user->roles->pluck('name')->first();
				}

				$success['token'] = $user->createToken('mavii')->accessToken;
				return response()->json(['success' => $success, 'user' => new UserResource($user)]);
			}
		} else { 
			return response()->json('Login inválido', 401);
		} 
	}

	public function logout(Request $request) {
		$user = auth()->user()->token();
		$user->revoke();
		return response()->json(['success' => 'Você deslogou com sucesso']);
	}

	public function second_step_register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'city_id' => 'required'
		], [
			'city_id.required' => 'Por favor informe a Cidade.'
		]);

		if ($validator->fails()) {
			return response()->json($validator->errors()->first(), 400);
		} else {
			$user = User::find(auth()->user()->id);
			$user->type = $request->get('type');
			$user->cpf = only_numbers($request->get('cpf'));
			$user->cnpj = only_numbers($request->get('cnpj'));
			$user->company_name = only_numbers($request->get('company_name'));

			if ($user->save()) {
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
				$user->role = $user->roles->pluck('name')->first();
				return new UserResource($user);
			}
		}
	}

	public function filter(Request $request)
	{
		$lat = $request->get('lat');
		$lng = $request->get('lng');

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
		
		return new UserCollection($users);
	}
}
