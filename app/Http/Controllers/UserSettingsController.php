<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email|string|max:255',
        ]);

        $user->update(['email' => $request->email]);

        return redirect()->route('user.settings')->with('success', 'Settings updated.');
    }
}
