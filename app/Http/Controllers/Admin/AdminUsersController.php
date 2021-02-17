<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::paginate(20)
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(AdminUpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if (User::first()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'First user cannot be deleted.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
