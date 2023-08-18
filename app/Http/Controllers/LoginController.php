<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{

    public function show(): View
    {
        return view('login');
    }

    public function login(LoginFormRequest $request)
    {
        $user = User::where('email', $request->get('email'))->whereNotNull('email_verified_at')->first();
        if(!$user || !Hash::check($request->get('password'), $user->password)) {
            throw ValidationException::withMessages(['email' => ['Email or password is not valid']]);
        }
        Auth::login($user);

        return redirect('/');
    }
}
