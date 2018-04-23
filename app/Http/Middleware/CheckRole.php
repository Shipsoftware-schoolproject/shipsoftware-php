<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole {
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (!Auth::user()->isAdmin()) {
            return response()->view(
                'errors.custom',
                [
                    'title' => '403 - Forbidden',
                    'message' => 'You don\'t have an ' . $role . ' role!'
                ]
            );
        }

        return $next($request);
    }
}