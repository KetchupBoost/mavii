<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

use App\Device;
use App\Http\Resources\DeviceResource;

class DevicesController extends Controller
{
	public function store(Request $request)
	{
		$device = new Device([
			'token' => $request->get('token'),
			'platform' => $request->get('platform'),
			'user_id' => Auth::user()->id
		]);

		if ($device->save()) {
			return new DeviceResource($device);
		}
	}

	// Custom methods

	public function get_token(Request $request)
	{
		$device = Device::where('user_id', $request->get('user_id'))->orderBy('created_at', 'desc')->first();

		if ($device) {
			return new DeviceResource($device);
		} else {
			return response()->json([], 200);
		}
	}
}
