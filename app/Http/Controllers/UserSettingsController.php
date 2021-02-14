<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;
use App\Models\User;

class UserSettingsController extends Controller
{    
    public function update(UpdateUserSettingsRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('user.settings')->with('success', 'Settings updated.');
    }
}
