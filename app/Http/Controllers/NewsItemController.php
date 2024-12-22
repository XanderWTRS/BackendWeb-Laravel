<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    // For displaying all news items on the welcome page
    public function index()
    {
        $newsItems = NewsItem::orderBy('publication_date', 'desc')->get();
        return view('welcome', compact('newsItems'));
    }

    // For showing a specific news item (if needed in a dedicated page)
    public function show($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('news.show', compact('newsItem'));
    }

    // Admin: Create a new news item
    public function create()
    {
        return view('news.create');
    }

    // Admin: Store a new news item
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'publication_date' => 'required|date',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/news_images', 'public');
        }

        NewsItem::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('welcome')->with('success', 'News item created successfully.');
    }

    // Admin: Edit a news item
    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('news.edit', compact('newsItem'));
    }

    // Admin: Update an existing news item
    public function update(Request $request, $id)
    {
        $newsItem = NewsItem::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'publication_date' => 'required|date',
        ]);

        if ($request->hasFile('image')) {
            if ($newsItem->image && Storage::exists('public/' . $newsItem->image)) {
                Storage::delete('public/' . $newsItem->image);
            }
            $path = $request->file('image')->store('uploads/news_images', 'public');
            $newsItem->image = $path;
        }

        $newsItem->update([
            'title' => $request->title,
            'content' => $request->content,
            'publication_date' => $request->publication_date,
        ]);

        return redirect()->route('welcome')->with('success', 'News item updated successfully.');
    }

    // Admin: Delete a news item
    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        if ($newsItem->image && Storage::exists('public/' . $newsItem->image)) {
            Storage::delete('public/' . $newsItem->image);
        }
        $newsItem->delete();

        return redirect()->route('welcome')->with('success', 'News item deleted successfully.');
    }
}
