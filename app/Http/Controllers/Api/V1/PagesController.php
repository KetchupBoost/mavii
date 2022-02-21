<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Page;
use App\Http\Resources\PageResource;

class PagesController extends Controller
{
	public function show($slug)
	{
		return new PageResource(Page::where('slug', $slug)->first());
	}
}
