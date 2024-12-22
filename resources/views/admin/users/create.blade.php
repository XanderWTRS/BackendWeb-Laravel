<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Create New User</h1>

    <!-- Error messages -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
            <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
            <input type="text" id="username" name="username" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Verjaardag -->
        <div class="mb-4">
            <label for="verjaardag" class="block text-gray-700 font-bold mb-2">Birthday</label>
            <input type="date" id="verjaardag" name="verjaardag" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Profielfoto -->
        <div class="mb-4">
            <label for="profielfoto" class="block text-gray-700 font-bold mb-2">Profile Photo</label>
            <input type="file" id="profielfoto" name="profielfoto" class="border border-gray-300 rounded w-full p-2">
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label for="bio" class="block text-gray-700 font-bold mb-2">Bio</label>
            <textarea id="bio" name="bio" class="border border-gray-300 rounded w-full p-2"></textarea>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
            <input type="password" id="password" name="password" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <!-- Is Admin -->
        <div class="mb-4">
            <label for="isAdmin" class="inline-flex items-center">
                <input type="checkbox" id="isAdmin" name="isAdmin" value="1" class="mr-2">
                Make Admin
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create User
        </button>
    </form>
</div>
