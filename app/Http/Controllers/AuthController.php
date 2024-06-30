<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AuthController
{

    public function __construct()
    {
    }

    public function gateway(Request $request)
    {
        if ($session = $request->cookie('session')) {
            if (Cache::has('user_session_' . $session)) {
                return redirect('/')->withCookie('session', '', 0, '/');
            } else {
                return view('admin_auth');
            }
        } else {
            if ($request->has('token')) {
                if ($request->input('token') === env('ADMIN_TOKEN', '')) {
                    $session_id = (string)Str::uuid();
                    Cache::put('user_session_' . $session_id, 1, 43200);
                    return redirect('/admin/judge')->withCookie(cookie('session', $session_id, 60, '/'));
                } else {
                    return redirect('/');
                }
            } else {
                return view('admin_auth');
            }
        }
    }

}

