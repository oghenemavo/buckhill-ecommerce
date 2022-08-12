<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        $type = null;
        switch ($userType) {
            case 'admin':
                $type = '1';
                break;
            case 'regular':
                $type = '0';
                break;
        }
        if(auth()->user()->is_admin == $type){
            return $next($request);
        }
        return response()->json([
            'status' => false,
            'message' => 'You do not have permission to access for this page.'
        ], Response::HTTP_FORBIDDEN);
    }
}
