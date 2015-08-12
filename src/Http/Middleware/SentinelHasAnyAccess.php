<?php

namespace Iboinas\Backoffice\Http\Middleware;

use Closure, \Sentinel, Session;

class SentinelHasAnyAccess
{

    public function handle($request, Closure $next, $permissions )
    {
        // First make sure there is an active session
        if (!Sentinel::check()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(route('backoffice.login'));
            }
        }

        $permissions = explode('|',$permissions);

        // Check if the user has access to one of the permissions in the array
        if (!Sentinel::hasAnyAccess($permissions)) {

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flash('notice', 'Unauthorized Access!');
                Sentinel::logout();
                return redirect()->route('backoffice.login');
            }
        }

        // All clear - we are good to move forward
        return $next($request);
    }



}
