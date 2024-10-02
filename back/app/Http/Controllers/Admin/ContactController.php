<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::first();
        return view('admin.extra.contact.index', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'email' => 'required|email',
        'address' => 'required',
        'map' => 'required',
    ]);

    try {
        $contact = Contact::updateOrCreate(
            ['id' => 1], // Assuming you want to always update the first record
            $request->only(['phone', 'email', 'address', 'map'])
        );

        return redirect()->route('contact.index')->with('success', 'Contact information updated successfully');
    } catch (\Exception $e) {
        return redirect()->route('contact.index')->with('error', 'Failed to update contact information: ' . $e->getMessage());
    }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
