<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Page;

class PagesController extends Controller
{
  public function show(Request $request, $slug)
  {
  	if(!$request->ajax()) {
  		$page = Page::where('slug', $slug)->first();
  		return view('pages.show', ['title' => $page->title, 'page' => $page]);
  	} else {
  		return view('pages.show_ajax', ['page' => Page::where('slug', $slug)->first()]);
  	}
  }
}
