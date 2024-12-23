<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\FAQItem;
use App\Models\UserQuestion;

class FAQController extends Controller
{
    public function adminIndex()
    {
        $categories = Category::with('faqItems')->get();
        $userQuestions = UserQuestion::with('user')->get();
        return view('admin.faq.index', compact('categories', 'userQuestions'));
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

    public function submitQuestion(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Je moet ingelogd zijn om een vraag te kunnen stellen.');
        }

        $request->validate([
            'question' => 'required|string|max:255',
        ]);

        UserQuestion::create([
            'user_id' => auth()->id(),
            'question' => $request->question,
        ]);

        return redirect()->back()->with('success', 'Je vraag is ingediend en zal door een admin worden beoordeeld.');
    }
    public function viewUserQuestions()
    {
        $questions = UserQuestion::with('user')->get();
        return view('admin.faq.index', compact('questions'));
    }
    public function addToFAQ(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'answer' => 'required|string',
        ]);

        $userQuestion = UserQuestion::findOrFail($id);

        FAQItem::create([
            'category_id' => $request->category_id,
            'question' => $userQuestion->question,
            'answer' => $request->answer,
        ]);
        $userQuestion->delete();

        return redirect()->route('admin.faq.index')->with('success', 'Vraag succesvol toegevoegd aan de FAQ.');
    }
    public function deleteUserQuestion($id)
{
    $userQuestion = UserQuestion::findOrFail($id);
    $userQuestion->delete();

    return redirect()->route('admin.faq.index')->with('success', 'Vraag verwijderd.');
}

}
