<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileMessage;

class ProfileMessageController extends Controller
{
    public function store(Request $request, $toUserId)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        ProfileMessage::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $toUserId,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message posted successfully!');
    }

    public function index($toUserId)
    {
        $profileMessages = ProfileMessage::where('to_user_id', $toUserId)->with('fromUser')->latest()->get();

        return view('profile.messages', compact('profileMessages'));
    }
}
