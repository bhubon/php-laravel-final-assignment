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

        // if ($request->user()->role === $role && $request->user()->role === 'admin') {
        //     return redirect('/dashboard');

        // } elseif ($request->user()->role === $role && $request->user()->role === 'company') {
        //     return redirect('/company/dashboard');

        // } elseif ($request->user()->role === $role && $request->user()->role === 'candidate') {
        //     return redirect('/user/dashboard');

        // } elseif ($request->user()->role !== $role) {
        //     return redirect('/user/dashboard');
        // }

        

        return $next($request);
    }
}
