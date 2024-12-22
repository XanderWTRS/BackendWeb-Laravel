@extends('layouts.user')

@section('title', 'Profile')

@section('content')

    <div class="container mx-auto mt-10">
        <div class="profile-header mb-5 text-center">
            <h1 class="text-2xl font-bold">{{ $user->username }}'s Profile</h1>
            <div>
                @if ($user->profielfoto)
                    <img src="{{ asset('/' . $user->profielfoto) }}" alt="Profile Picture" class="w-40 h-40 mx-auto rounded-full">
                @else
                    <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" class="w-40 h-40 mx-auto rounded-full">
                @endif
            </div>
        </div>
        <div class="profile-info text-center">
            <p><strong>Birthday:</strong> {{ $user->verjaardag ?? 'Not provided' }}</p>
            <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</p>
        </div>

        @auth
            <div class="post-message-form mt-10">
                <h2 class="text-xl font-bold">Post a message</h2>
                <form method="POST" action="{{ route('profile.message.store', $user->id) }}" class="mt-5">
                    @csrf
                    <div class="mb-4">
                        <textarea name="message" class="border border-gray-300 rounded w-full p-2" rows="3" placeholder="Write your message here..." required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Post Message
                    </button>
                </form>
            </div>
        @endauth

        <div class="messages-list mt-10">
            <h2 class="text-xl font-bold">Messages</h2>
            @if ($profileMessages->isEmpty())
                <p class="text-gray-600">No messages yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach ($profileMessages as $message)
                        <li class="border-b pb-4">
                            <p><strong>{{ $message->fromUser->username }}:</strong> {{ $message->message }}</p>
                            <p class="text-sm text-gray-600">{{ $message->created_at->diffForHumans() }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection
