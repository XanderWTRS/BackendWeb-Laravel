<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<header class="flex items-center bg-white shadow-md p-4 justify-between">
    <div>
        <x-home-button />
        <a href="{{ route('messages.index') }}" class="relative inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600 hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 14h.01M16 10h.01M21 12c0-4.418-3.582-8-8-8s-8 3.582-8 8c0 3.866 3.14 7.086 7 7.93V20l2.75-2.25c3.72-.415 6.25-3.295 6.25-6.75z"/>
            </svg>
        </a>
    </div>
    <h1 class="text-2xl font-bold text-gray-800 -mr-52">BackendWeb - Project</h1>
    <div>
        <a href="{{ route('contact.show') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Contact</a>
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
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
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
