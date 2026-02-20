<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('superadmin.users.index', compact('users'));
    }

    // THIS IS THE MISSING PIECE
    public function updateRole(Request $request, User $user)
    {
        // Safety Rule: You cannot demote yourself
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Security rule: You cannot demote yourself.');
        }

        $request->validate([
            'role' => 'required|in:user,admin,super_admin',
        ]);

        // Save the new role to the database
        $user->update([
            'role' => $request->role,
        ]);

        return back()->with('success', "Role for {$user->name} updated to ".strtoupper(str_replace('_', ' ', $request->role)));
    }
}
    