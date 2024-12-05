<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

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
        $request->user()->sendEmailVerificationNotification();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    public function updatePassword(Request $request)
    {
        if ($request->method() === 'GET') {
            abort(405); // Method Not Allowed
        }
        // Validate the input
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|confirmed|min:8|different:current_password',
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
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

    // Prevent admin from deleting their account
    if ($user->role === 'admin') {
        return redirect()->route('profile.edit')->withErrors(['error' => 'Admins cannot delete their accounts.']);
    }

    // Delete related data (tasks, customers, etc.)
    // Adjust according to your database relationships
    $user->tasks()->delete(); // Deletes all tasks created by the user
    $user->customers()->delete(); // Deletes all customers added by the user

    // Delete any other related models as needed
    // Example: $user->orders()->delete(); $user->comments()->delete();

    // Finally, delete the user account
    $user->delete();

    // Log out the user after deleting their account
    auth()->logout();

    // Redirect to the homepage with a success message
    return redirect('/')->with('status', 'Your account and all associated data have been deleted successfully.');
}

}
