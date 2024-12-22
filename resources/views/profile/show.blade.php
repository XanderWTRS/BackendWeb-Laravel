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
                <img src="{{ asset('default-avatar.png') }}" alt="Default Avatar" class="w-12 h-12 rounded-full mx-auto">
            @endif
            </div>
        </div>
        <div class="profile-info text-center">
            <p><strong>Birthday:</strong> {{ $user->verjaardag ?? 'Not provided' }}</p>
            <p><strong>Bio:</strong> {{ $user->bio ?? 'No bio available' }}</p>
        </div>
    </div>
@endsection
