<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfWrongRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            // If admin is trying to access user dashboard
            if ($user->isAdmin() && $request->is('dashboard')) {
                return redirect()->route('admin.dashboard');
            }
            
            // If regular user is trying to access admin routes
            if (!$user->isAdmin() && $request->is('admin/*')) {
                return redirect()->route('user.dashboard');
            }
        }
        
        return $next($request);
    }
}
