<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return Auth::user() ? self::redirectToHome() : self::view('manager.auth.register', [], trans('messages.register_page'));
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->only(['name', 'email', 'password']);
        $params = array_merge($params,[
            'password' => Hash::make($params['password']),
            'role_id' => 1
        ]);
        $user = User::query()->create($params);

        Auth::login($user);

        return self::redirectToHome();
    }
}
