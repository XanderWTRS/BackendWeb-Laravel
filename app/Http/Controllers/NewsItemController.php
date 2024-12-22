<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsItemController extends Controller
{
    public function show($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('news.show', compact('newsItem'));
    }

    public function create()
    {
        return view('news.create');
    }

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

    public function edit($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        return view('news.edit', compact('newsItem'));
    }

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

    public function destroy($id)
    {
        $newsItem = NewsItem::findOrFail($id);
        if ($newsItem->image && Storage::exists('public/' . $newsItem->image)) {
            Storage::delete('public/' . $newsItem->image);
        }
        $newsItem->delete();

        return redirect()->route('welcome')->with('success', 'News item deleted successfully.');
    }

    public function like($id)
    {
        $newsItem = NewsItem::findOrFail($id);

        if ($newsItem->likes()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'You have already liked this news item.');
        }

        $newsItem->likes()->create(['user_id' => auth()->id()]);

        return back()->with('success', 'News item liked.');
    }

    public function comment(Request $request, $id)
    {
        $request->validate(['content' => 'required|string']);

        $newsItem = NewsItem::findOrFail($id);

        $newsItem->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added.');
    }
}
