<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Specialty;

class SpecialtiesController extends Controller
{
	public function show($slug)
  {
  	$specialty = Specialty::where('slug', $slug)->first();
  	$users = User::select('users.*')
  							->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
								->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
								->where('subspecialties.specialty_id', $specialty->id)
								->groupBy('users.id')
  							->get();

  	return view('specialties.show', ['title' => $specialty->name, 'specialty' => $specialty, 'users' => $users]);
  }
}
