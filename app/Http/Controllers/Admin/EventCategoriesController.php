<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\EventCategory;

class EventCategoriesController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['can:criar categoria de eventos', 'can:editar categoria de eventos', 'can:apagar categoria de eventos'], ['only' => ['index']]);
		$this->middleware(['can:criar categoria de eventos'], ['only' => ['create', 'store']]);
		$this->middleware(['can:editar categoria de eventos'], ['only' => ['edit', 'update']]);
		$this->middleware(['can:apagar categoria de eventos'], ['only' => ['destroy']]);
  }
  
	public function index()
	{
		$event_categories = EventCategory::paginate(10);
		return view('admin.event_categories.index', ['title' => 'Categorias de Eventos', 'event_categories' => $event_categories]);
	}

	public function create()
	{
		return view('admin.event_categories.create', ['title' => 'Nova Categoria de Evento']);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
		]);

		$event_category = new EventCategory([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'type' => $request->get('type'),
			'slug' => Str::slug($request->get('name'), '-'),
			'user_id' => auth()->user()->id
		]);

		$event_category->save();

		return redirect()->route('admin.event_categories.index')->with('success', 'Categoria de Evento salva com sucesso');
	}

	public function edit($id)
	{
		$event_category = EventCategory::find($id);
		return view('admin.event_categories.edit', ['title' => 'Editar Categoria de Evento', 'event_category' => $event_category]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
		]);

		$event_category = EventCategory::find($id);

		$event_category->name = $request->get('name');
		$event_category->description = $request->get('description');
		$event_category->type = $request->get('type');

		$event_category->slug = Str::slug($request->get('name'), '-');
		$event_category->user_id = auth()->user()->id;
		$event_category->save();

		return redirect()->route('admin.event_categories.index')->with('success', 'Categoria de Evento salva com sucesso');
	}

	public function destroy($id)
	{
		$event_category = EventCategory::find($id);
		
		try {
			$event_category->delete();
			return redirect()->route('admin.event_categories.index')->with('success', 'Categoria de Evento apagada com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.event_categories.index')->with('warning', 'O Categoria de Evento não pode ser apagada no momento porque possui eventos vinculados.');
			} else {
				return redirect()->route('admin.event_categories.index')->with('danger', 'Não foi possível apagar a Categoria de Evento.');
			}
		}
	}

	// Custom methods

	public function update_status(Request $request, $id)
	{
		$event_category = EventCategory::find($id);
		$status = str_replace('"', '', $request->get('status'));

		$event_category->status = $status;
		$event_category->save();

		return response()->json(['message' => 'Categoria de Evento alterada com sucesso.'], 200);
	}
}
