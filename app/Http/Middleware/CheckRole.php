<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Check if user is logged in
        if (! auth()->check()) {
            return redirect('/login');
        }

        // 2. Check if the user's role exists in the allowed roles array
        if (! in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized. You do not have permission to access this area.');
        }

        // 3. User is authorized, let them proceed!
        return $next($request);
    }
}
