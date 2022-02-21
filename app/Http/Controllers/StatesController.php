<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\State;

class StatesController extends Controller
{
	public function cities($id)
	{
		$state = State::find($id);

		return response()->json($state->cities);;
	}
}
