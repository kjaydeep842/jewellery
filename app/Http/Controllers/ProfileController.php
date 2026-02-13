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
        return view('frontend.profile.edit', [

            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $user = $request->user();

            // Handle Profile Picture Upload
            if ($request->hasFile('profile_picture')) {
                // Delete old picture if exists
                if ($user->profile_picture) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_picture);
                }

                $path = $request->file('profile_picture')->store('profile-pictures', 'public');
                $user->profile_picture = $path;
            }

            // Update user details
            $user->name = trim($request->first_name . ' ' . $request->last_name);
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->otp_notify = $request->boolean('otp_notify');

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            // Handle Address
            $addressData = [
                'name' => $user->name,
                'phone' => $user->phone,
                'country' => 'India', // Default for now
                'type' => $request->address_type ?? 'Home',
            ];

            // Only update fields that are actually filled to avoid SQL errors
            foreach (['address_line_1', 'address_line_2', 'city', 'state', 'zip'] as $field) {
                if ($request->filled($field)) {
                    $addressData[$field] = $request->input($field);
                }
            }

            // Only attempt update if we have at least address_line_1 or zip or other partial data
            if ($request->anyFilled(['address_line_1', 'address_line_2', 'city', 'state', 'zip'])) {
                $user->addresses()->updateOrCreate(
                    ['is_default' => true],
                    $addressData
                );
            }

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Profile Update Failed: ' . $e->getMessage());
            return Redirect::route('profile.edit')->withErrors(['error' => 'An error occurred while updating your profile. Please try again.']);
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
