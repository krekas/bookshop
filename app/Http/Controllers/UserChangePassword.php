<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\NotSameAsOldPassword;
use Illuminate\Support\Facades\Hash;

class UserChangePassword extends Controller
{
    public function update(Request $request, User $user)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|confirmed|max:255|min:8',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->route('user.settings')->with('error', 'Wrong old password.');
        }

        if (Hash::check($request->new_password, auth()->user()->password)) {
            return redirect()->route('user.settings')->with('error', 'New password cannot be the same.');
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        return redirect()->route('user.settings')->with('success', 'Password updated.');
    }
}
