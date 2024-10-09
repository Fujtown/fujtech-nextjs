<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingTable;
use Illuminate\Http\Request;

class PricingTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingTable = PricingTable::all();
        return view('extra.pricing-table.show', compact('pricingTable'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('extra.pricing-table.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'points' => 'required|array',
            'points.*' => 'required|string',
            'available_point' => 'nullable|array',
            'available_point.*' => 'nullable|string',
        ]);

        // dd('working');
    
        $points = $request->points;
        $available_points = $request->available_point ?? [];

        $mergedPoints = [];
        foreach ($points as $index => $point) {
            $mergedPoints[] = [
                'point' => $point,
                'available' => isset($available_points[$index]) ? $available_points[$index] : null,
            ];
        }
        
        PricingTable::create([
            'title' => $request->title,
            'price' => $request->price,
            'month' => $request->month,
            'year' => $request->year,
            'points' => json_encode($mergedPoints),

        ]);
    
        return redirect()->route('pricing-table.index')->with('success', 'Pricing Table Added Successfully');
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
        $pricingTable = PricingTable::find($id);
        return view('extra.pricing-table.edit', compact('pricingTable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'points' => 'required|array',
            'points.*' => 'required|string',
            'available_point' => 'nullable|array',
            'available_point.*' => 'nullable|string',
        ]);

        $points = $request->points;
        $available_points = $request->available_point ?? [];

        $mergedPoints = [];
        foreach ($points as $index => $point) {
            $mergedPoints[] = [
                'point' => $point,
                'available' => isset($available_points[$index]) ? $available_points[$index] : null,
            ];
        }

        $pricingTable = PricingTable::find($id);
        $pricingTable->update([
            'title' => $request->title,
            'price' => $request->price,
            'month' => $request->month,
            'year' => $request->year,
            'points' => json_encode($mergedPoints),
        ]);

        return redirect()->route('pricing-table.index')->with('success', 'Pricing Table Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pricingTable = PricingTable::find($id);
        $pricingTable->delete();
        return redirect()->route('pricing-table.index')->with('success', 'Pricing Table Deleted Successfully');
    }
}
