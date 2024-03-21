<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

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
        $request->user()->fill($request->validated());

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

    /**
     * Generate a new API token for the authenticated user.
     */
    public function generateAPIKey(): string
    {
        $user = Auth::user();
        
        // Delete any existing Sanctum tokens
        PersonalAccessToken::where('tokenable_id', $user->id)->delete();
        // generate a new token
        return $user->createToken("{$user}")->plainTextToken;

    }

    /**
     * Revoke the user's API token.
     */
    public function revokeAPIKey(Request $request): RedirectResponse
    {
        $request->user()->tokens()->delete();

        return Redirect::route('profile.edit');
    }
}
     
