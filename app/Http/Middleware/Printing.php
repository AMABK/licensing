<?php

namespace App\Http\Middleware;

use Closure;

class Printing {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $check = \App\User_role::where('user_id',  \Auth::user()->id)
                ->where('role_id',5)
                ->count();
        if ($check < 1) {
            return redirect('/invoice/view-invoices')
                                        ->with('global', '<div class="alert alert-warning">User does not have printing privileges</div>');
        }

        return $next($request);
    }

}
