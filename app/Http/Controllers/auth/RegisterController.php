<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    private $userServices;

    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(RegisterRequest $request)
    {
        $this->userServices->register($request);

        // log the user in after registation
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('profile', Auth::user()->username)->with('success', 'You have successfully registered and logged in!');
        }

        return redirect()->route('register')->with('errors', 'Registration Failed, please try again.');
    }
}
