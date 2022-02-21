<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;

use App\Info;

class InfoController extends Controller
{
	public function __construct()
  {
		$this->middleware(['can:editar informacoes basicas'], ['only' => ['edit', 'update']]);
  }
  
	public function edit($id)
	{
		$info = Info::find($id);
		return view('admin.info.edit', ['title' => 'Informações Básicas', 'info' => $info]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'email1' => 'required|email',
			'cellphone1' => 'required',
			'address' => 'required'
		]);

		$info = Info::find($id);

		$info->twitter = $request->get('twitter');
		$info->facebook = $request->get('facebook');
		$info->instagram = $request->get('instagram');
		$info->youtube = $request->get('youtube');
		$info->whatsapp = only_numbers($request->get('whatsapp'));
		$info->snapchat = $request->get('snapchat');
		$info->email1 = $request->get('email1');
		$info->email2 = $request->get('email2');
		$info->phone1 = only_numbers($request->get('phone1'));
		$info->phone2 = only_numbers($request->get('phone2'));
		$info->cellphone1 = only_numbers($request->get('cellphone1'));
		$info->cellphone2 = only_numbers($request->get('cellphone2'));
		$info->address = $request->get('address');
		$info->user_id = Auth::id();
		$info->save();

		return redirect()->route('admin.info.edit', $id)->with('success', 'Informações Gerais salvas com sucesso');
	}
}
