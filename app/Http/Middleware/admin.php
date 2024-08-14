<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

    class admin
    {
        public function handle($request, Closure $next)
        {
            if (Auth::check()) {
                \Log::info('User ID: ' . Auth::id() . ' admin: ' . Auth::user()->admin);
                if (Auth::user()->admin == 1 || Auth::user()->admin == 0) {
                    return $next($request);
                }
            }

            return redirect('/login')->with('error', 'You do not have admin access');
        }

    }

