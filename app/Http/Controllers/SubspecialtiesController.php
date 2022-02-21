<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Subspecialty;

class SubspecialtiesController extends Controller
{
	public function show($specialty, $slug)
  {
  	$subspecialty = Subspecialty::where('slug', $slug)->first();
  	$users = User::select('users.*')
  							->join('user_subspecialties', 'user_subspecialties.user_id', '=', 'users.id')
								->join('subspecialties', 'subspecialties.id', '=', 'user_subspecialties.subspecialty_id')
								->where('subspecialties.id', $subspecialty->id)
								->groupBy('users.id')
  							->get();

  	return view('subspecialties.show', ['title' => $subspecialty->name, 'specialty' => $specialty, 'users' => $users]);
  }
}
