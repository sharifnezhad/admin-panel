<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return Auth::user() ? self::redirectToHome() : self::view('manager.auth.login', [], trans('messages.login_page'));
    }

    public function login(LoginRequest $request)
    {
        $user = $request->only('email', 'password');
        if (!Auth::attempt($user,$request->remember))
            return back()->withErrors(trans('messages.user_does_not_exist'));

        return self::redirectToHome();
    }
}
