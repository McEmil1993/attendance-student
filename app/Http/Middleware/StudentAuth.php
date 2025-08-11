<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentAuth
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard(name: 'student')->check()) {
            return redirect()->route('student.login'); // adjust this route
        }

        return $next($request);
    }
}
