<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify');
    }


    public function verify(Request $request)
    {
        /** @var User $user */
        if ($user = User::find($request->route('id'))) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
        return redirect(route('login'))->with('status', 'Your email has been verified');
    }
}
