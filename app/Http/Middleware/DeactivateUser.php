<?php

namespace App\Http\Middleware;

use Closure;

class DeactivateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if ($user and $user->status == 'deactivated') {
            \Auth::logout();
            return redirect()->route('login')->withErrors([
                'deactivated_user' => 'You can\'t login with deactivated user'
            ]);
        }
        return $next($request);
    }
}
