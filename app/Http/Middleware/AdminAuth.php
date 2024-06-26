<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminAuth
{

    /**
     * Initialize all needed data.
     */
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($session = $request->cookie('session')) {
            if (Cache::has('user_session_' . $session)) {
                return $next($request);
            } else {
                return redirect('admin/auth');
            }
        } elseif ($request->hasHeader('X-Nightingale-Auth')) {
            if ($request->header('X-Nightingale-Auth') === env('ADMIN_TOKEN', '')) {
                return $next($request);
            } else {
                return response('', 403);
            }
        } elseif ($request->has('token')) {
            if ($request->input('token') === env('ADMIN_TOKEN', '')) {
                $session_id = (string)Str::uuid();
                Cache::put('user_session_' . $session_id, 1, 43200);
                return $next($request)->withCookie(cookie('session', $session_id, 720, '/'));
            } else {
                return redirect('admin/auth');
            }
        } else {
            return redirect('admin/auth');
        }
    }

}
