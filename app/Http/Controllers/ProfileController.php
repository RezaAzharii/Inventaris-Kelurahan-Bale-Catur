<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.index')->with('succes', 'Profil berhasil diperbarui!');
    }
}