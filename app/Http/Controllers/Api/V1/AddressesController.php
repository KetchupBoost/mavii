<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Address;
use App\Http\Resources\AddressResource;

class AddressesController extends Controller
{
	public function edit($id)
	{
		return new AddressResource(Address::find($id));
	}

	public function update(Request $request, $id)
	{
		$address = Address::find($id);
		$address->postal_code = only_numbers($request->get('postal_code'));
		$address->public_place = $request->get('public_place');
		$address->street_number = $request->get('street_number');
		$address->complement = $request->get('complement');
		$address->neighborhood = $request->get('neighborhood');
		$address->city_id = $request->get('city_id');
		$address->slug = Str::slug($request->get('postal_code').' '.$request->get('street_number'), '-');
		$address->user_id = auth()->user()->id;

		if ($address->save()) {
			return new AddressResource($address);
		}
	}
}
