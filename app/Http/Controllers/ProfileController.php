<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\SocialUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function show($id): View
    {
        $user = User::findOrFail($id);
        
        return view('profile.show', compact('user'));
    }

    public function showusername($username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        
        return view('profile.show', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $path = $request->file('profile_image')->store('users/profile-imgs/avatar-'.$user->id, 'public');
            $user->profile_image = $path;
        }

        if ($request->hasFile('profile_banner')) {
            if ($user->profile_banner) {
                Storage::disk('public')->delete($user->profile_banner);
            }
            $path = $request->file('profile_banner')->store('users/profile-banners/avatar-'.$user->id, 'public');
            $user->profile_banner = $path;
        }

        $user->save();

        return redirect('/profile/' . $user->id)->with('status', 'profile-updated');
    }

    /**
     * Update the user's social media information.
     */
    public function socialUpdate(SocialUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        $user->fill($validatedData);
        $user->save();

        return redirect('/profile/' . $user->id)->with('status', 'social-media-updated');
    }

    public function pfprem(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);

            $user->profile_image = null;
            $user->save();

            return redirect('/profile/' . $user->id)->with('status', 'profile-img-removed');
        }
    }

    public function bnerem(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->profile_banner) {
            Storage::disk('public')->delete($user->profile_banner);

            $user->profile_banner = null;
            $user->save();

            return redirect('/profile/' . $user->id)->with('status', 'banner-img-removed');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
