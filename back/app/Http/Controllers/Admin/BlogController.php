<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB Max
            'keywords' => 'nullable|string',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);
          // Generate slug from title
         $slug = Str::slug($request->title);

    
         $data = $request->only(['category_id', 'keywords', 'content', 'tags']);

        $data['title'] = $request->title; // Include title in the data
        $data['slug'] = $slug; // Add the generated slug to the data
    
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = $file->hashName(); // Get a unique filename

            // Store original image
            $path = $file->storeAs('blog_covers', $filename, 'public');
            $data['cover_image'] = $path;

            // Create and store resized image
            $manager = new ImageManager(new Driver());
            $resizedImage = $manager->read($file)->cover(500, 500);
            $resizedPath = 'blog_covers/resized/' . $filename;
            Storage::disk('public')->put($resizedPath, $resizedImage->toJpeg());
            $data['cover_image_resized'] = $resizedPath;
        }
    
        Blog::create($data);
    
        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
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
        $blog = Blog::find($id);
        $categories = Category::all();
        return view('blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB Max
            'keywords' => 'nullable|string',
            'content' => 'required|string',
            'tags' => 'nullable|string',
        ]);
    
        $blog = Blog::findOrFail($id);
        // Generate slug from title
         $slug = Str::slug($request->title);
         
        $data = $request->except('cover_image');
        $data['slug'] = $slug; // Add the generated slug to the data

        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($blog->cover_image) {
                Storage::disk('public')->delete($blog->cover_image);
            }
    
            // Store new image
          
            $path = $request->file('cover_image')->store('blog_covers', 'public');
            $data['cover_image'] = $path;

           
        }

    
        $blog->update($data);
    
        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        Storage::disk('public')->delete($blog->cover_image);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
