<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if(auth()->user()->role('user')){
                throw new \Exception("Error Processing Request", 400); 
            }
        return $next($request);
    }
}
