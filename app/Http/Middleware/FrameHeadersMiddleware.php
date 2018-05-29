<?php

namespace GaneshaSIGE\Http\Middleware;

use Closure;

class FrameHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

public function handle($request, Closure $next)
{
     $response = $next($request);
     $response->header('X-Frame-Options', 'ALLOW FROM http://localhost:8000/');
     $response->header('X-XSS-Protection', 'ALLOW FROM http://localhost:8000/');
     $response->header('X-Content-Options', 'ALLOW FROM http://localhost:8000/');
     $response->header('XSRF-TOKEN', 'ALLOW FROM http://localhost:8000/');
     return $response;
 }
}
