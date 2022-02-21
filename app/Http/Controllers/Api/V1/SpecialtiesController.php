<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Specialty;
use App\User;
use App\Http\Resources\SpecialtyCollection as SpecialtyResource;
use App\Http\Resources\UserCollection as UserResource;

class SpecialtiesController extends Controller
{
	public function index()
	{
		return new SpecialtyResource(Specialty::where('status', 1)->get());
	}

	public function show($slug)
  {
  	$specialty = Specialty::where('slug', $slug)->first();
  	$users = User::select('users.*')
  							->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
								->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
								->where('subspecialties.specialty_id', $specialty->id)
								->groupBy('users.id')
  							->get();

  	return new UserResource($users);
  }
}
