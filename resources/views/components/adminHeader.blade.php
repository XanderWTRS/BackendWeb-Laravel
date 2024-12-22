<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<div class="flex justify-between items-center bg-white shadow-md p-4">
    <x-home-button />
    <div>
        <a href="{{ route('admin.users.create') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-4 mx-2">
            Create User
        </a>
        <a href="{{ route('admin.faq.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded my-4 mx-2">
            Manage FAQ
        </a>
        <a href="{{ route('admin.contact.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-4 mx-2">
            View Contact Messages
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
            Dashboard
        </a>
    </div>
</div>
