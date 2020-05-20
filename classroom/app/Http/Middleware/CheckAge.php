<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
       // dd($request->id->user_id);
        $user = $request->user();
        $member = $request->id->classroomuser->where('user_id', $user->id)->count();
    //   dd($member);
        if ($member > 0) {
            return $next($request);
        }

        return redirect('/control');
    }
}
