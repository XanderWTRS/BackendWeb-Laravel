<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Http\Request;

class PrivateMessageController extends Controller
{
    public function index()
    {
        $messages = PrivateMessage::where('to_user_id', auth()->id())
            ->with('fromUser')
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function send(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to send a message.'], 401);
        }

        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        PrivateMessage::create([
            'from_user_id' => auth()->id(),
            'to_user_id' => $request->to_user_id,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true, 'message' => 'Message sent!']);
    }

    public function someControllerMethod() {
        $users = User::all();
        return view('your-view-name', compact('users'));
    }
}
