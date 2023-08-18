<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Http\Requests\ValidateEmailFromRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function show(): View
    {
        return view('register');
    }

    public function register(RegistrationFormRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        event(new Registered($user));

        return redirect()
            ->route('login')
            ->with('status', __('Your account has been created, check your email for the verification link.'));
    }

    public function validateEmail(ValidateEmailFromRequest $request): array
    {
        return ['success' => true];
    }
}
