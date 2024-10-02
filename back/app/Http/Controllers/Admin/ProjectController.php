<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Services::all();
        return view('admin.project.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'publish_date' => 'required|date',
        ]);

        $data = $request->only(['title', 'description', 'service_id', 'publish_date']);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('project_covers', 'public');
            $data['cover_image'] = $path;
        }

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');
                $images[] = $path;
            }
            $data['images'] = $images;
        }

       Project::create($data);
        

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
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
        $project = Project::find($id);
        $services = Services::all();
        return view('admin.project.edit', compact('project', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'service_id' => 'required|exists:services,id',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'images' => 'nullable|array',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'publish_date' => 'required|date',
    ]); 

    $project = Project::findOrFail($id);
    
    $data = $request->except(['cover_image', 'images']);

    // Handle cover image
    if ($request->hasFile('cover_image')) {
        // Delete old cover image
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        $data['cover_image'] = $request->file('cover_image')->store('project_covers', 'public');
    }

    // Handle project images
    if ($request->hasFile('images')) {
        $images = [];
        foreach ($request->file('images') as $image) {
            $images[] = $image->store('project_images', 'public');
        }
        
        // Delete old images
        if ($project->images) {
            foreach ($project->images as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }
        
        $data['images'] = $images;
    }

    $project->update($data);

    return redirect()->route('projects.index')->with('success', 'Project updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        Storage::disk('public')->delete($project->cover_image);
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image);
        }
        $project->delete();
      
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
