<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FAQItem;

class FAQController extends Controller
{
    public function adminIndex()
    {
        $categories = Category::with('faqItems')->get();
        return view('admin.faq.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Category::create(['name' => $request->name]);

        return redirect()->route('admin.faq.index')->with('success', 'Category created successfully.');
    }

    public function storeFAQ(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        FAQItem::create($request->all());

        return redirect()->route('admin.faq.index')->with('success', 'FAQ item created successfully.');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name]);

        return redirect()->route('admin.faq.index')->with('success', 'Category updated successfully.');
    }

    public function updateFAQ(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);
        $faqItem = FAQItem::findOrFail($id);
        $faqItem->update($request->only(['question', 'answer']));

        return redirect()->route('admin.faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.faq.index')->with('success', 'Category deleted successfully.');
    }

    public function destroyFAQ($id)
    {
        $faqItem = FAQItem::findOrFail($id);
        $faqItem->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ item deleted successfully.');
    }
}
