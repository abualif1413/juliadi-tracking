<?php

namespace App\Http\Middleware;

use Closure;

class PreventLoginPage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $employeeIdFromSession = session()->has('EmployeeID');
        if($employeeIdFromSession != null) {
            return \Redirect('/');
        }
        return $next($request);
    }
}
