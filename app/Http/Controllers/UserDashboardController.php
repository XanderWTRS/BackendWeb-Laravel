<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $user->id],
            'verjaardag' => ['nullable', 'date'],
            'profielfoto' => ['nullable', 'image', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);
        if ($request->hasFile('profielfoto')) {
            if ($user->profielfoto && Storage::exists('public/' . $user->profielfoto)) {
                Storage::delete('public/' . $user->profielfoto);
            }

            $path = $request->file('profielfoto')->store('uploads/profile_pictures', 'public');
            $user->profielfoto = $path;
        }

        $user->username = $request->username;
        $user->verjaardag = $request->verjaardag;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
    }
}
