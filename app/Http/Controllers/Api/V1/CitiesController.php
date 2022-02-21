<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\City;
use App\Http\Resources\CityCollection as CityResource;

class CitiesController extends Controller
{
	public function index($state_id)
	{
		return new CityResource(City::where('state_id', $state_id)->get());
	}
}
