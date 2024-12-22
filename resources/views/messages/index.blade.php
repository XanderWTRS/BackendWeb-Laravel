@extends('layouts.user')

@section('title', 'Messages')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Your Messages</h1>
        <ul class="space-y-4">
            @forelse ($messages as $message)
                <li class="p-4 bg-gray-100 rounded shadow">
                    <p><strong>From:</strong> {{ $message->fromUser->username }}</p>
                    <p>{{ $message->message }}</p>
                    <p class="text-sm text-gray-600">{{ $message->created_at->diffForHumans() }}</p>
                </li>
            @empty
                <p>No messages yet.</p>
            @endforelse
        </ul>
    </div>
@endsection
