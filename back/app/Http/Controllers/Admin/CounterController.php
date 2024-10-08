<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $counter = Counter::first();
        return view('extra.counter.index', compact('counter'));
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
        // dd($request->all());
        $request->validate([
            'years_experience' => 'required',
            'projects_done' => 'required',
            'happy_clients' => 'required',
            'expert_members' => 'required',
        ]);
      
        try {
                $counter = Counter::updateOrCreate(
                ['id' => 1], // Assuming you want to always update the first record
                $request->only(['years_experience', 'projects_done', 'happy_clients', 'expert_members'])
            );
    
            return redirect()->back()->with('success', 'Counter updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update counter: ' . $e->getMessage());
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
