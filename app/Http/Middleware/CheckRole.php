<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {   
        // Get authenticated  user
    	$user = Auth::user();

    	// Check user role
    	if($user && $user->role != $role) {
    		return redirect('sign-in');
    	}
    	
        return $next($request);
    }
}
