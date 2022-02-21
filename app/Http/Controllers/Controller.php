<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Auth;
use View;

use App\Info;
use App\Page;
use App\Specialty;
use App\Notification;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $info;
    protected $pages;
    protected $specialties;

    public function __construct()
    {
		$this->middleware(function ($request, $next) {
            $this->info = Info::first();
            $this->pages = Page::where('status', 1)->get();
            $this->specialties = Specialty::where('status', 1)->get();
            if (!Auth::check()) {
                View::share(['info' => $this->info, 'pages' => $this->pages, 'specialties' => $this->specialties]);
            } else {
                $this->notifications = Notification::where([
                                                        ['status', 0],
                                                        ['user_id', Auth::id()]
                                                    ])->get();
                View::share(['info' => $this->info, 'pages' => $this->pages, 'specialties' => $this->specialties, 'notifications' => $this->notifications]);
            }
            
        	return $next($request);
    	});
	}
}
