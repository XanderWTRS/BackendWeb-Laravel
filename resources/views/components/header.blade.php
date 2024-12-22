<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<header class="flex items-center bg-white shadow-md p-4 justify-between">
    <x-home-button />
    <h1 class="text-2xl font-bold text-gray-800">BackendWeb - Project</h1>
    <a href="{{ route('contact.show') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Contact</a>
    <div>
        @auth
        @if (auth()->user()->isAdmin)
            <a href="{{ route('admin.users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-4">
                Dashboard
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-4">
                Profiel
            </a>
        @endif

        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mx-4">
                Logout
            </button>
        </form>
        @else
        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mx-4">
            Login
        </a>
        <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mx-4">
            Register
        </a>
        @endauth
    </div>
</header>
