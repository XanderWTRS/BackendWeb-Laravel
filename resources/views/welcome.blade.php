@extends('layouts.user')

@section('title', 'Home')

@section('content')
        <div class="container mx-auto mt-10 w-[vw-70]">
            <!-- SEARCH BAR -->
            <div class="search-bar mt-5">
            <label for="user-search" class="block text-gray-700 font-bold mb-2">Search Users</label>
            <input type="text" id="user-search" class="border border-gray-300 rounded w-full p-2" placeholder="Search by username...">
            <ul id="search-results" class="mt-2 border border-gray-300 rounded bg-white"></ul>
            </div>

            <!-- NEWS -->
            <div class="flex justify-between items-center my-5">
            <h2 class="text-2xl font-bold">Latest News</h2>
            @auth
                @if (auth()->user()->isAdmin)
                <a href="{{ route('news.create') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Create News Item
                </a>
                @endif
            @endauth
            </div>
            @if ($newsItems->isEmpty())
            <p class="text-gray-600">No news items available at the moment.</p>
            @else
            <div class="news-list space-y-4 select-none">
                @foreach ($newsItems as $newsItem)
                <div class="news-item border-b pb-4" x-data="{ open: false }">
                    <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
                    <h3 class="text-lg font-bold text-blue-500">{{ $newsItem->title }}</h3>
                    <p class="text-sm text-gray-600">Published on: {{ $newsItem->publication_date }}</p>
                    <div class="flex space-x-2 items-center">
                        @auth
                        @if (auth()->user()->isAdmin)
                        <a href="{{ route('news.edit', $newsItem->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                            Edit
                        </a>
                        <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center justify-center">
                            Delete
                            </button>
                        </form>
                        @endif
                        @endauth
                    </div>
                    </div>
                    <div x-show="open" x-transition class="mt-3">
                    @if ($newsItem->image)
                        <img src="{{ asset('storage/' . $newsItem->image) }}" alt="News Image" class="w-80 mb-3 rounded">
                    @endif
                    <p>{{ $newsItem->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- FAQ -->
            <div class="faq-section mt-10">
            <h2 class="text-2xl font-bold">Frequently Asked Questions</h2>
            @if ($categories->isEmpty())
                <p>No FAQs available at the moment.</p>
            @else
                @foreach ($categories as $category)
                <div class="faq-category mt-4">
                    <h3 class="text-xl font-semibold">{{ $category->name }}</h3>
                    <ul class="faq-items list-disc pl-5">
                    @foreach ($category->faqItems as $faq)
                        <li class="faq-item mt-2">
                        <strong>{{ $faq->question }}</strong>
                        <p>{{ $faq->answer }}</p>
                        </li>
                    @endforeach
                    </ul>
                </div>
                @endforeach
            @endif
            </div>
        </div>
@endsection
