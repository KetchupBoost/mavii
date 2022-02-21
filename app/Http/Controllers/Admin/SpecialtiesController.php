<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Specialty;

class SpecialtiesController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['can:criar especialidade', 'can:editar especialidade', 'can:apagar especialidade'], ['only' => ['index']]);
		$this->middleware(['can:criar especialidade'], ['only' => ['create', 'store']]);
		$this->middleware(['can:editar especialidade'], ['only' => ['edit', 'update']]);
		$this->middleware(['can:apagar especialidade'], ['only' => ['destroy']]);
  }
  
	public function index()
	{
		$specialties = Specialty::paginate(10);

		return view('admin.specialties.index', ['title' => 'Especialidades', 'specialties' => $specialties]);
	}

	public function create()
	{
		return view('admin.specialties.create', ['title' => 'Nova Especialidade']);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$specialty = new Specialty([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'icon' => $request->get('icon'),
			'cover' => !$request->hasFile('cover') ? NULL : $request->cover->store('uploads/specialties/' . Str::slug($request->get('name'), '-')),
			'slug' => Str::slug($request->get('name'), '-'),
			'user_id' => auth()->user()->id
		]);

		$specialty->save();

		return redirect()->route('admin.specialties.index')->with('success', 'Especialidade salva com sucesso');
	}

	public function edit($id)
	{
		$specialty = Specialty::find($id);
		return view('admin.specialties.edit', ['title' => 'Editar Especialidade', 'specialty' => $specialty]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$specialty = Specialty::find($id);

		$specialty->name = $request->get('name');
		$specialty->description = $request->get('description');
		$specialty->icon = $request->get('icon');

		if ($request->hasFile('cover')) {
			Storage::delete($request->get('current_file'));
			$specialty->cover = $request->cover->store('uploads/specialties/' . $specialty->slug);
		}

		$specialty->slug = Str::slug($request->get('name'), '-');
		$specialty->user_id = auth()->user()->id;
		$specialty->save();

		return redirect()->route('admin.specialties.index')->with('success', 'Especialidade salva com sucesso');
	}

	public function destroy($id)
	{
		$specialty = Specialty::find($id);
		
		try {
			$specialty->delete();
			return redirect()->route('admin.specialties.index')->with('success', 'Especialidade apagada com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.specialties.index')->with('warning', 'A Especialidade não pode ser apagada no momento porque possui subespecialidades vinculadas.');
			} else {
				return redirect()->route('admin.specialties.index')->with('danger', 'Não foi possível apagar a Especialidade.');
			}
		}
	}

	// Custom methods

	public function update_status(Request $request, $id)
	{
		$specialty = Specialty::find($id);
		$status = str_replace('"', '', $request->get('status'));

		$specialty->status = $status;
		$specialty->save();

		return response()->json(['message' => 'Especialidade alterada com sucesso.'], 200);
	}
}
