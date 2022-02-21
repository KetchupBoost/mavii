<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

use App\User;

class UsersController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['role:admin']);
  }
  
	public function index()
	{
		$users = User::all();
		return view('admin.users.index', ['title' => 'Usuários', 'users' => $users]);
	}

	public function create()
	{
		$roles = Role::get();
		return view('admin.users.create', ['title' => 'Novo Usuário', 'roles' => $roles]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'password' => 'required',
			'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = new User([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => bcrypt($request->get('password')),
			'phone' => only_numbers($request->get('phone')),
			'cellphone' => only_numbers($request->get('cellphone')),
			'birthdate' => \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d'),
			'gender' => $request->get('gender'),
			'cpf' => only_numbers($request->get('cpf')),
			'avatar' => !$request->hasFile('avatar') ? NULL : $request->avatar->store('uploads/users/' . $user->slug),
			'slug' => Str::slug($request->get('name'), '-')
		]);

		$user->save();
		$user->assignRole($request->input('role'));

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function edit($id)
	{
		$user = User::find($id);
		$roles = Role::get();
		return view('admin.users.edit', ['title' => 'Editar Usuário', 'user' => $user, 'roles' => $roles]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$user = User::find($id);

		$user->name = $request->get('name');
		$user->email = $request->get('email');
		if ($request->get('password')) {
			$user->password = bcrypt($request->get('password'));	
		}
		$user->phone = only_numbers($request->get('phone'));
		$user->cellphone = only_numbers($request->get('cellphone'));
		$user->birthdate = \Carbon\Carbon::parse(str_replace('/', '-', $request->get('birthdate')))->format('Y-m-d');
		$user->gender = $request->get('gender');
		$user->cpf = only_numbers($request->get('cpf'));
		$user->status = $request->get('status');

		if ($request->hasFile('avatar')) {
			Storage::delete($request->get('current_file'));
			$user->avatar = $request->avatar->store('uploads/users/' . $user->slug);
		}

		$user->slug = Str::slug($request->get('name'), '-');
		$user->save();

		foreach ($user->roles as $key => $user_role) {
			$user->removeRole($user_role);
		}
		$user->assignRole($request->input('role'));

		return redirect()->route('admin.users.index')->with('success', 'Usuário salvo com sucesso');
	}

	public function destroy($id)
	{
		$user = User::find($id);

		try {
			$user->delete();
			return redirect()->route('admin.users.index')->with('success', 'Usuário apagado com sucesso');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.users.index')->with('warning', 'O Usuário não pode ser apagado porque possui eventos realizados.');
			} else {
				return redirect()->route('admin.users.index')->with('danger', 'Não foi possível apagar a Usuário.');
			}
		}
	}

	public function show($slug)
	{
		return view('admin.users.show', ['user' => User::where('slug', $slug)->first()]);
	}
}
