<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="flex justify-between items-center bg-white shadow-md p-4">
    <x-home-button />
    <a href="{{ route('admin.users.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        Dashboard
    </a>
</div>

<main class="w-[70vw] mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-5">FAQ Management</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif

    <!-- Categorieën en Items -->
    <div>
        @foreach ($categories as $category)
            <div class="mb-8">
                <h2 class="text-2xl font-bold mt-5">{{ $category->name }}</h2>
                <form action="{{ route('admin.faq.destroyCategory', $category->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete Category
                    </button>
                </form>
                <ul class="list-disc pl-5 mt-3">
                    @foreach ($category->faqItems as $faqItem)
                        <li class="mt-3">
                            <strong>{{ $faqItem->question }}</strong>
                            <p class="mt-1">{{ $faqItem->answer }}</p>
                            <form action="{{ route('admin.faq.destroyFAQ', $faqItem->id) }}" method="POST" class="inline-block ml-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- Nieuwe Categorie Toevoegen -->
    <h2 class="text-2xl font-bold mt-10">Add New Category</h2>
    <form method="POST" action="{{ route('admin.faq.storeCategory') }}" class="mt-5 bg-gray-100 p-5 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Category Name</label>
            <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full p-2" required>
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Add Category</button>
    </form>

    <!-- Nieuwe FAQ Toevoegen -->
    <h2 class="text-2xl font-bold mt-10">Add New FAQ</h2>
    <form method="POST" action="{{ route('admin.faq.storeFAQ') }}" class="mt-5 bg-gray-100 p-5 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
            <select id="category_id" name="category_id" class="border border-gray-300 rounded w-full p-2" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="question" class="block text-gray-700 font-bold mb-2">Question</label>
            <input type="text" id="question" name="question" class="border border-gray-300 rounded w-full p-2" required>
        </div>
        <div class="mb-4">
            <label for="answer" class="block text-gray-700 font-bold mb-2">Answer</label>
            <textarea id="answer" name="answer" class="border border-gray-300 rounded w-full p-2" rows="5" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Add FAQ</button>
    </form>
</main>
