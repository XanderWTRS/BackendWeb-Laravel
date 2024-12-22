<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        if ($user->isAdmin) {
            return redirect()->route('admin.users.index')->with('error', 'User is already an admin.');
        }

        $user->update(['isAdmin' => true]);
        return redirect()->route('admin.users.index')->with('success', 'User promoted to admin.');
    }

    public function revokeAdmin(User $user)
    {
        if (!$user->isAdmin) {
            return redirect()->route('admin.users.index')->with('error', 'User is not an admin.');
        }

        $user->update(['isAdmin' => false]);
        return redirect()->route('admin.users.index')->with('success', 'Admin rights revoked.');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'verjaardag' => ['required', 'date'],
            'profielfoto' => ['nullable', 'image'],
            'bio' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', 'min:8'],
            'isAdmin' => ['nullable', 'boolean'],
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('profielfoto')) {
            $profilePhotoPath = $request->file('profielfoto')->store('images/profile_pictures', 'public');
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'verjaardag' => $request->verjaardag,
            'profielfoto' => $profilePhotoPath,
            'bio' => $request->bio,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->isAdmin ?? false,
        ]);
        return redirect()->route('admin.users.index')->with('success', 'New user created successfully.');
    }
}
