<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\EventCategory;
use App\Http\Resources\EventCategoryCollection as EventCategoryResource;

class EventCategoriesController extends Controller
{
	public function index()
	{
		return new EventCategoryResource(EventCategory::all());
	}
}
