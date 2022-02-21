<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Hour;

class HoursController extends Controller
{
	// Custom methods

  public function update_status(Request $request, $id)
  {
    $hour = Hour::find($id);
    $status = str_replace('"', '', $request->get('status'));

    $hour->status = $status;
    $hour->save();

    return response()->json(['message' => 'Horário alterado com sucesso.'], 200);
  }
}
