<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {

		public function handle($request, Closure $next)
		{
				if (!app()->isLocal() && !$request->secure()) {
						return redirect()->secure($request->path());
				}

				return $next($request);
		}
}