<?php
<<<<<<< HEAD
namespace buzzeroffice\Http\Middleware;
=======
namespace App\Http\Middleware;
>>>>>>> 9364050604be82bb21bf77314501118a9268d954

use Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->guest() || !Auth::user()->isAdmin()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/login');
            }
        }

        return $next($request);
    }
}
