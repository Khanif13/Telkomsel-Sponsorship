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
        $request->validate([
            'name' => 'required|string|max:255',
            'organizer_name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'organizer_category' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        // Update seluruh data profil yang dikirim dari form
        $user->update($request->only([
            'name', 'organizer_name', 'position', 'contact_email', 'address', 'organizer_category',
        ]));

        return back()->with('success', 'Profil dan detail instansi berhasil diperbarui!');
    }
}
