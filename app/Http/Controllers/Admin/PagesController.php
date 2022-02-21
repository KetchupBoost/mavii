<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Page;

class PagesController extends Controller
{
  public function __construct()
  {
    $this->middleware(['can:criar pagina', 'can:editar pagina', 'can:apagar pagina'], ['only' => ['index']]);
    $this->middleware(['can:criar pagina'], ['only' => ['create', 'store']]);
    $this->middleware(['can:editar pagina'], ['only' => ['edit', 'update']]);
    $this->middleware(['can:apagar pagina'], ['only' => ['destroy']]);
  }
  
  public function index()
  {
    $pages = Page::paginate(10);

    return view('admin.pages.index', ['title' => 'Páginas', 'pages' => $pages]);
  }

  public function create()
  {
    return view('admin.pages.create', ['title' => 'Nova Página']);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'body' => 'required'
    ]);

    $page = new Page([
      'title' => $request->get('title'),
      'body' => $request->get('body'),
      'slug' => Str::slug($request->get('title'), '-'),
      'user_id' => auth()->user()->id
    ]);

    $page->save();

    return redirect()->route('admin.pages.index')->with('success', 'Página salva com sucesso');
  }

  public function edit($id)
  {
    $page = Page::find($id);
    return view('admin.pages.edit', ['title' => 'Editar Página', 'page' => $page]);
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'title' => 'required',
      'body' => 'required'
    ]);

    $page = Page::find($id);

    $page->title = $request->get('title');
    $page->body = $request->get('body');

    $page->slug = Str::slug($request->get('title'), '-');
    $page->user_id = auth()->user()->id;
    $page->save();

    return redirect()->route('admin.pages.index')->with('success', 'Página salva com sucesso');
  }

  public function destroy($id)
  {
    $page = Page::find($id);
    $page->delete();

    return redirect()->route('admin.pages.index')->with('success', 'Página apagada com sucesso');
  }

  public function show($slug)
  {
    return view('admin.pages.show', ['page' => Page::where('slug', $slug)->first()]);
  }

  // Custom methods

  public function update_status(Request $request, $id)
  {
    $page = Page::find($id);
    $status = str_replace('"', '', $request->get('status'));

    $page->status = $status;
    $page->save();

    return response()->json(['message' => 'Página alterada com sucesso.'], 200);
  }
}
