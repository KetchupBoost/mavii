<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Specialty;
use App\Subspecialty;

class SubspecialtiesController extends Controller
{
	public function __construct()
  {
		$this->middleware(['can:criar subespecialidade', 'can:editar subespecialidade', 'can:apagar subespecialidade'], ['only' => ['index']]);
		$this->middleware(['can:criar subespecialidade'], ['only' => ['create', 'store']]);
		$this->middleware(['can:editar subespecialidade'], ['only' => ['edit', 'update']]);
		$this->middleware(['can:apagar subespecialidade'], ['only' => ['destroy']]);
  }
	
	public function index($specialty_id)
	{
		$specialty = Specialty::find($specialty_id);
		$subspecialties = Subspecialty::where('specialty_id', $specialty_id)->paginate(10);

		return view('admin.subspecialties.index', ['title' => 'Subespecialidade', 'subspecialties' => $subspecialties, 'specialty' => $specialty]);
	}

	public function create($specialty_id)
	{
		return view('admin.subspecialties.create', ['title' => 'Nova Subespecialidade', 'specialty_id' => $specialty_id]);
	}

	public function store($specialty_id, Request $request)
	{
		$request->validate([
			'name' => 'required',
			'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$specialty = Specialty::find($specialty_id);
		$subspecialties = Subspecialty::where('specialty_id', $specialty_id)->get();

		$subspecialty = new Subspecialty([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'cover' => !$request->hasFile('cover') ? NULL : $request->cover->store('uploads/subspecialties/' . Str::slug($request->get('name'), '-')),
			'slug' => Str::slug($request->get('name'), '-'),
			'specialty_id' => $specialty_id,
			'user_id' => auth()->user()->id
		]);

		$subspecialty->save();

		return redirect()->route('admin.specialties.subspecialties.index', $specialty_id)->with('success', 'Subespecialidade salva com sucesso');
	}

	public function edit($specialty_id, $id)
	{
		$subspecialty = Subspecialty::find($id);
		
		return view('admin.subspecialties.edit', ['title' => 'Editar Subespecialidade', 'specialty_id' => $specialty_id, 'subspecialty' => $subspecialty]);
	}

	public function update($specialty_id, Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$specialty = Specialty::find($specialty_id);
		$subspecialty = Subspecialty::find($id);

		$subspecialty->name = $request->get('name');
		$subspecialty->description = $request->get('description');

		if ($request->hasFile('cover')) {
			Storage::delete($request->get('current_file'));
			$subspecialty->cover = $request->cover->store('uploads/subspecialties/' . $subspecialty->slug);
		}

		$subspecialty->slug = Str::slug($request->get('name'), '-');
		$subspecialty->specialty_id = $specialty_id;
		$subspecialty->user_id = auth()->user()->id;

		$subspecialty->save();

		return redirect()->route('admin.specialties.subspecialties.index', $specialty_id)->with('success', 'Subespecialidade salva com sucesso');
	}

	public function destroy($specialty_id, $id)
	{
		$subspecialty = Subspecialty::find($id);
		$subspecialty->delete();

		return redirect()->route('admin.specialties.subspecialties.index', $specialty_id)->with('success', 'Subespecialidade apagada com sucesso');
	}

	// Custom methods

	public function update_status(Request $request, $id)
	{
		$subspecialty = Subspecialty::find($id);
		$status = str_replace('"', '', $request->get('status'));

		$subspecialty->status = $status;
		$subspecialty->save();

		return response()->json(['message' => 'Subespecialidade alterada com sucesso.'], 200);
	}

	public function update_featured(Request $request, $id)
	{
		$subspecialty = Subspecialty::find($id);
		$featured = str_replace('"', '', $request->get('featured'));

		$subspecialty->featured = $featured;
		$subspecialty->save();

		return response()->json(['message' => 'Subespecialidade alterada com sucesso.'], 200);
	}
}
