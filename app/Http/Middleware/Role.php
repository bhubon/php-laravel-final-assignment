<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if ($request->user()->role == $role) {
            // echo $request->user()->role ;
            // echo $role;
            // die();
            return $next($request);
        }
        return redirect()->back()->with('warning', 'You dont have permission to access this page');

    }
}
