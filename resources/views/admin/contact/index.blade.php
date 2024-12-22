<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="flex justify-between items-center bg-white shadow-md p-4">
    <x-home-button />
    <a href="{{ route('admin.users.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-4 m-10">
        Create User
    </a>
    <a href="{{ route('admin.faq.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded my-4 m-10">
        Manage FAQ
    </a>
    <a href="{{ route('admin.contact.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-4 m-10">
        View Contact Messages
    </a>
    <a href="{{ route('admin.users.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Dashboard
    </a>
</div>

<main>
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Contact Messages</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <table class="table-auto mt-5 w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Naam</th>
                    <th class="border px-4 py-2">E-mail</th>
                    <th class="border px-4 py-2">Bericht</th>
                    <th class="border px-4 py-2">Geantwoord</th>
                    <th class="border px-4 py-2">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $message->name }}</td>
                    <td class="border px-4 py-2">{{ $message->email }}</td>
                    <td class="border px-4 py-2">{{ $message->message }}</td>
                    <td class="border px-4 py-2">
                        @if ($message->answered)
                            <span class="text-green-600 font-bold">Ja</span>
                        @else
                            <span class="text-red-600 font-bold">Nee</span>
                        @endif
                    </td>
                    <td class="border px-4 py-2 flex gap-2">
                        <form action="{{ route('admin.contact.reply', $message->id) }}" method="POST">
                            @csrf
                            <textarea name="reply" rows="2" placeholder="Type je antwoord hier..." class="border border-gray-300 rounded w-full p-2"></textarea>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mt-2">Antwoord</button>
                        </form>
                        <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Verwijder</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
