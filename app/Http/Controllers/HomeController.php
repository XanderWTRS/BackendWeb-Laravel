<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsItem;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $newsItems = NewsItem::orderBy('publication_date', 'desc')->get(); // Fetch latest news
        $categories = Category::with('faqItems')->get(); // Fetch FAQs with categories

        return view('welcome', compact('newsItems', 'categories'));
    }
}
