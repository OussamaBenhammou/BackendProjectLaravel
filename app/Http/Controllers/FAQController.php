<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $categories = Category::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    public function faq()
    {
        $categories = Category::with('faqs')->get();
        return view('faq.faq', compact('categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('faq.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'required|string',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->category = $request->category;
        $faq->save();

        return redirect()->route('index')->with('success', 'FAQ added successfully.');
    }

    public function edit(Faq $faq)
    {
        $categories = Category::all();
        return view('faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully.');
    }
}
