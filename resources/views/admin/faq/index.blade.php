@extends('layouts.admin')

@section('title', 'FAQ Management')

@section('content')
    <div class="w-[70vw] mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5">FAQ Management</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
                {{ session('success') }}
            </div>
        @endif

        <div>
            @foreach ($categories as $category)
                <div class="mb-8 bg-gray-100 p-5 rounded shadow-md">
                    <div class="flex justify-between items-center text-center">
                        <h2 class="text-2xl font-bold mt-5">{{ $category->name }}</h2>

                        <button
                            type="button"
                            class="edit-category-button bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}">
                            Edit Category
                        </button>

                        <form action="{{ route('admin.faq.destroyCategory', $category->id) }}" method="POST" class="inline-block ml-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete Category
                            </button>
                        </form>
                    </div>

                    <ul class="list-disc pl-5 mt-3">
                        @foreach ($category->faqItems as $faqItem)
                            <li class="mt-3">
                                <strong>{{ $faqItem->question }}</strong>
                                <p class="mt-1">{{ $faqItem->answer }}</p>

                                <button
                                    type="button"
                                    class="edit-faq-button bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded"
                                    data-id="{{ $faqItem->id }}"
                                    data-question="{{ $faqItem->question }}"
                                    data-answer="{{ $faqItem->answer }}">
                                    Edit
                                </button>

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

        <h2 class="text-2xl font-bold mt-10">Add New Category</h2>
        <form method="POST" action="{{ route('admin.faq.storeCategory') }}" class="mt-5 bg-gray-100 p-5 rounded shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Category Name</label>
                <input type="text" id="name" name="name" class="border border-gray-300 rounded w-full p-2" required>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">Add Category</button>
        </form>

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
    </div>

    <div id="edit-category-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded shadow-md p-6 w-1/2">
                <h2 class="text-xl font-bold mb-4">Edit Category</h2>
                <form id="edit-category-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-category-name" class="block text-gray-700">Category Name</label>
                        <input type="text" id="edit-category-name" name="name" class="border border-gray-300 rounded w-full p-2" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
                    <button type="button" id="close-category-modal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <div id="edit-faq-modal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded shadow-md p-6 w-1/2">
                <h2 class="text-xl font-bold mb-4">Edit FAQ</h2>
                <form id="edit-faq-form" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit-faq-question" class="block text-gray-700">Question</label>
                        <input type="text" id="edit-faq-question" name="question" class="border border-gray-300 rounded w-full p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="edit-faq-answer" class="block text-gray-700">Answer</label>
                        <textarea id="edit-faq-answer" name="answer" class="border border-gray-300 rounded w-full p-2" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
                    <button type="button" id="close-faq-modal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
