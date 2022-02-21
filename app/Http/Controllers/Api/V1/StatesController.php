<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\State;
use App\Http\Resources\StateCollection as StateResource;

class StatesController extends Controller
{
	public function index()
	{
		return new StateResource(State::all());
	}
}
