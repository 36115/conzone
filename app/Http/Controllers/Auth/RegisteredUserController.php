<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

/**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'displayname' => 'string|max:30|min:4',
            'username' => 'required|string|regex:/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/|max:20|min:4',
            'bio' => 'string|max:2500',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => ['nullable', 'file', 'mimes:jpeg, png, jpg, gif', 'max:2048'],
        ], [
            'email.unique' => 'The email address is already registered.',
            'username.regex' => 'The username can only contain letters, numbers, dashes, and underscores.',
        ]);

        $user = User::create([
            'displayname' => $request->username,
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index', absolute: false));
    }
}
