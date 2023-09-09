<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AdministrasiUserController;

class CheckStatusApproveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = new AdministrasiUserController;
        $status = (int) $user->cekDataApproveUser();
        if($status != 200 ){
            return redirect('/unathorized-page');
        }        
        return $next($request);
    }
}
