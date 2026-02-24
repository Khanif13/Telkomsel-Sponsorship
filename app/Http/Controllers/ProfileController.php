<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone_number' => [
                'required', 'string', 'min:10', 'max:15',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^(?:0|\+?62)(\d{3})/', $value, $matches)) {
                        $prefix = $matches[1];
                        $validPrefixes = ['811', '812', '813', '821', '822', '823', '851', '852', '853'];
                        if (! in_array($prefix, $validPrefixes)) {
                            $fail("{$prefix} is not a Telkomsel number.");
                        }
                    } else {
                        $fail('The phone number format is invalid.');
                    }
                },
            ],
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return back()->with('success', 'Profile settings updated successfully!');
    }
}
