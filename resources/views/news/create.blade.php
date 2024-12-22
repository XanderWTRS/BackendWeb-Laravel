<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-header />

<main class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-5">Create News Item</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-gray-700 font-bold">Title</label>
            <input type="text" id="title" name="title" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <div>
            <label for="content" class="block text-gray-700 font-bold">Content</label>
            <textarea id="content" name="content" class="border border-gray-300 rounded w-full p-2" rows="5" required></textarea>
        </div>

        <div>
            <label for="image" class="block text-gray-700 font-bold">Image</label>
            <input type="file" id="image" name="image" class="border border-gray-300 rounded w-full p-2">
        </div>

        <div>
            <label for="publication_date" class="block text-gray-700 font-bold">Publication Date</label>
            <input type="date" id="publication_date" name="publication_date" class="border border-gray-300 rounded w-full p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create News Item
        </button>
    </form>
</main>
