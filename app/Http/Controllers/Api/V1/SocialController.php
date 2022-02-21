<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\User;

use App\Http\Resources\UserResource;

class SocialController extends Controller
{
	public function login(Request $request)
	{
		$user = User::where('oauth_id', $request->get('oauth_id'))->orWhere('email', $request->get('email'))->first();

		if(!$user) {
			try {
				$createdUser = new User([
					'name' => $request->get('name'),
					'email' => $request->get('email'),
					'oauth_provider' => $request->get('oauth_provider'),
					'oauth_id' => $request->get('oauth_id'),
					'status' => 1,
					'slug' => 'slug'
				]);

				if ($createdUser->save()) {
					$createdUser->update([
						'slug' => Str::slug($createdUser->id . ' ' .$createdUser->name, '-')
					]);

					$createdUser = User::find($createdUser->id);

					// Mail::to($createdUser->email)->send(new UserCreated($createdUser));
				
					$request->request->add([
						'grant_type' => 'password',
						'client_id' => '2',
						'client_secret' => 'i2GhKiauLcj9FiqrncvopWKb3ar1jBohtM2N4DfR',
						'username' => $createdUser->email,
						'password' => 'password',
						'scope' => '*'
					]);

					$tokenRequest = Request::create('/oauth/token', 'post');
					$response = json_decode(Route::dispatch($tokenRequest)->getContent());

					$success['token'] = $response->access_token;
					return response()->json(['success' => $success, 'user' => new UserResource($createdUser)], 200);
				}
			} catch(\Exception $e) {
				return response()->json($e->getMessage(), 401);
			}
		} else {
			$request->request->add([
				'grant_type' => 'password',
				'client_id' => '2',
				'client_secret' => 'i2GhKiauLcj9FiqrncvopWKb3ar1jBohtM2N4DfR',
				'username' => $user->email,
				'password' => 'password',
				'scope' => '*'
			]);

			$tokenRequest = Request::create('/oauth/token', 'post');
			$response = json_decode(Route::dispatch($tokenRequest)->getContent());

			if ($user->hasRole(['cliente', 'profissional'])) {
				$user->role = $user->roles->pluck('name')->first();
			}

			$success['token'] = $response->access_token;
			return response()->json(['success' => $success, 'user' => new UserResource($user)], 200);
		}	
	}
}
