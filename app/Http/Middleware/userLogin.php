<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class userLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            /** @var App\Models\User */
            $user = Auth::user();
            $roles = Role::pluck('name')->toArray();
            if ($user->hasRole($roles)) {
                return $next($request);
            } else {
                return redirect('/dashboard')->with('error', 'No permissions');
            }
            abort(403);
        }
        return redirect('/');
    }
}
