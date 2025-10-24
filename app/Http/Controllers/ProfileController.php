<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            // remove old avatar if exists
            if ($request->user()->avatar) {
                try {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($request->user()->avatar);
                } catch (\Exception $e) {
                    // ignore delete failures
                }
            }

            $data['avatar'] = $path;
        }

        // Handle avatar removal if requested
        if ($request->boolean('remove_avatar')) {
            if ($request->user()->avatar) {
                try {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($request->user()->avatar);
                } catch (\Exception $e) {
                    // ignore delete failures
                }
            }

            $data['avatar'] = null;
        }

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
