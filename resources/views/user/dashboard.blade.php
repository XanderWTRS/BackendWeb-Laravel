<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-header />

<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Edit Your Profile</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.dashboard.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <input type="text" id="username" name="username" class="border border-gray-300 rounded w-full p-2" value="{{ $user->username }}" required>
        </div>

        <!-- Verjaardag -->
        <div class="mb-4">
            <label for="verjaardag" class="block text-gray-700 font-bold mb-2">Birthday</label>
            <input type="date" id="verjaardag" name="verjaardag" class="border border-gray-300 rounded w-full p-2" value="{{ $user->verjaardag }}">
        </div>

        <!-- Profielfoto -->
        <div class="mb-4">
            <label for="profielfoto" class="block text-gray-700 font-bold mb-2">Profile Photo</label>
            @if ($user->profielfoto)
                <img src="{{ asset('/' . $user->profielfoto) }}" alt="Profile Picture" class="w-32 h-32 rounded-full mb-2">
            @endif
            <input type="file" id="profielfoto" name="profielfoto" class="border border-gray-300 rounded w-full p-2">
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 font-bold mb-2">Bio</label>
            <textarea id="bio" name="bio" class="border border-gray-300 rounded w-full p-2">{{ $user->bio }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Update Profile
        </button>
    </form>
</div>
