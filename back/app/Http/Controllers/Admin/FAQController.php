<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::all();
        return view('faq.index', compact('faqs'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        // dd($request);
        $category = FAQ::create([
            'question' => $request->title,
            'answer' => $request->content,
        ]);

        return redirect()->route('faq.index')->with('success', 'Category created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = FAQ::find($id);

        return view('faq.edit',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'nullable|string',
        ]);
    
        $faq = FAQ::findOrFail($id);

         // Map the incoming request data to the database fields
        $data = [
            'question' => $request->input('title'),  // Map 'title' to 'question'
            'answer' => $request->input('content'),   // Map 'content' to 'answer'
        ];

        $faq->update($data);
    
        return redirect()->route('blogs.index')->with('success', 'FAQ  updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FAQ::find($id);
        $faq->delete();

    
        return redirect()->route('faq.index')
            ->with('success', 'FAQ deleted successfully');
    }
}
