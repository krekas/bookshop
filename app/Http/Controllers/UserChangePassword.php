<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\OldPasswordCheck;

class UserChangePassword extends Controller
{
    public function update(Request $request, User $user)
    {
        $request->validate([
            'old_password' => ['required', new OldPasswordCheck()],
            'new_password' => ['required', 'string', 'confirmed', 'max:255', 'min:8'],
        ]);

        $user->update(['password' => bcrypt($request->new_password)]);

        return redirect()->route('user.settings')->with('success', 'Password updated.');
    }
}
