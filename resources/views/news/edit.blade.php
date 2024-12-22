<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-header />

@if (session('success'))
    <div class="alert alert-success mb-4 p-4 rounded bg-green-100 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mb-4 p-4 rounded bg-red-100 text-red-700">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="w-4/5 mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Edit News Item</h1>
    <form method="POST" action="{{ route('news.update', $newsItem->id) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="flex flex-col">
            <label for="title" class="mb-2 font-semibold">Title</label>
            <input type="text" id="title" name="title" value="{{ $newsItem->title }}" required class="p-2 border rounded">
        </div>

        <div class="flex flex-col">
            <label for="content" class="mb-2 font-semibold">Content</label>
            <textarea id="content" name="content" required class="p-2 border rounded h-40">{{ $newsItem->content }}</textarea>
        </div>

        <div class="flex flex-col">
            <label for="image" class="mb-2 font-semibold">Image</label>
            <input type="file" id="image" name="image" class="p-2 border rounded">
            @if ($newsItem->image)
                <p class="mt-2">Current Image: <img src="{{ asset('storage/' . $newsItem->image) }}" alt="Current Image" width="100" class="border rounded"></p>
            @endif
        </div>

        <div class="flex flex-col">
            <label for="publication_date" class="mb-2 font-semibold">Publication Date</label>
            <input type="date" id="publication_date" name="publication_date" value="{{ $newsItem->publication_date }}" required class="p-2 border rounded">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Update News Item</button>
    </form>
</div>
