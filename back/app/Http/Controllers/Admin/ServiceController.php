<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Services::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required|string',
            'points' => 'nullable|array', // Validate points as an array
            'points.*' => 'string', // Validate each point as a string
        ]);

        $data = $request->only(['title', 'description']);
    
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('service_icons', 'public');
            $data['icon'] = $path;
        }
        
        // Store points as a JSON string or keep it as an array
         $data['points'] = json_encode($request->input('points', [])); // Convert points array to JSON


        Services::create($data);

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'description' => 'required|string',
       
    ]);

    $service = Services::findOrFail($id);

    $data = $request->only(['title', 'description']);

    if ($request->hasFile('icon')) {
        // Delete old icon
        Storage::disk('public')->delete($service->icon);

        // Store new icon
        $data['icon'] = $request->file('icon')->store('service_icons', 'public');
    }

    $service->update($data);

    return redirect()->route('services.index')->with('success', 'Service updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::find($id);
        Storage::disk('public')->delete($service->icon);
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }
}
