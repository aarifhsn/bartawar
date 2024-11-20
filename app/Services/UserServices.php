<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserServices
{
    public function register(RegisterRequest $request)
    {
        // Split full name into first name and last name
        $fullName = explode(' ', $request->input('full_name'), 2);
        $firstName = $fullName[0];
        $lastName = $fullName[1] ?? '';

        // prepare user data and create a new user record
        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return $user;
    }

    public function getAuthUserProfile()
    {
        return Auth::user();  // Get the currently logged-in user
    }

    public function getUserProfile($username)
    {
        $user = User::where('username', $username)->first();

        if (! $user) {
            abort(404, 'User not found');
        }

        return $user;
    }

    public function updateUserProfile($request)
    {
        // prepare userdata to be updated
        $userData = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'bio' => trim($request->input('bio')),
        ];

        // If avatar is provided, store it and add to the userData
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $userData['avatar'] = $path;

            // Delete old avatar if it exists
            if (Auth::user()->avatar) {
                Storage::disk('public')->delete(Auth::user()->avatar);
            }
        }

        // If password is provided, hash it and add to the userData
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        // Update the user's info
        User::where('id', Auth::user()->id)->update($userData);

        return 'Profile updated successfully';
    }
}
