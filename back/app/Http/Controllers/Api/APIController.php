<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Counter;
use App\Models\FAQ;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Services;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
class APIController extends Controller
{

    public function getPartners()
    {
        // Fetch partners from the database
        $partners = Partner::select('image','url')->get();

        // Get the base URL
        $baseUrl = url('/'); // This will give you the base URL of your application

        // Map through partners to include the full image URL
        $partnersWithFullImageUrl = $partners->map(function ($partner) use ($baseUrl) {
            $partner->pImg = $baseUrl . '/storage/' . $partner->image; // Adjust the path as necessary
            return $partner;
        });

                  // Get the latest updated_at timestamp to create a dynamic version
        $latestUpdate = $partners->max('updated_at'); // Get the latest updated_at timestamp
        $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

        return response()->json([
            'data' => $partnersWithFullImageUrl,
            'version' => $version,
        ]);
      
    }

    public function getServices()
    {
        // Fetch partners from the database
        $services = Services::select('title', 'icon', 'description','points')->get();

        // Get the base URL
        $baseUrl = url('/'); // This will give you the base URL of your application

        // Map through services to include the full image URL
        $servicesWithFullImageUrl = $services->map(function ($service) use ($baseUrl) {
            $service->sImg = $baseUrl . '/storage/' . $service->icon; // Adjust the path as necessary
            return $service;
        });
          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $services->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $servicesWithFullImageUrl,
        'version' => $version,
    ]);

        //return response()->json($servicesWithFullImageUrl); // Return partners with full image URLs as JSON
    }


    public function getBlogs()
    {
            // Fetch partners from the database
            $blogs = Blog::get();

          // Get the base URL
          $baseUrl = url('/'); // This will give you the base URL of your application

        
            // Map through blogs to include the full image URLs
            $blogsWithFullImageUrl = $blogs->map(function ($blog) use ($baseUrl) {
                $blog->bImg = $baseUrl . '/storage/' . $blog->cover_image; // Full image URL
                $blog->bcImg = $baseUrl . '/storage/' . $blog->cover_image_resized; // Resized image URL
                $blog->slug = Str::slug($blog->title); // Create a slug from the blog title
                $blog->date = Carbon::parse($blog->created_at)->format('M-d-Y'); // Format the created_at date

                return $blog; // Return the modified blog object
            });

       
          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $blogs->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $blogsWithFullImageUrl,
        'version' => $version,
    ]);

    }
    

    public function getBlogsLimit()
    {
         // Fetch the latest 3 blogs from the database, ordered by created_at in descending order
            $blogs = Blog::orderBy('created_at', 'DESC')->take(3)->get();


          // Get the base URL
          $baseUrl = url('/'); // This will give you the base URL of your application

        
            // Map through blogs to include the full image URLs
            $blogsWithFullImageUrl = $blogs->map(function ($blog) use ($baseUrl) {
                $blog->bImg = $baseUrl . '/storage/' . $blog->cover_image; // Full image URL
                $blog->bcImg = $baseUrl . '/storage/' . $blog->cover_image_resized; // Resized image URL
                $blog->slug = Str::slug($blog->title); // Create a slug from the blog title
                $blog->date = Carbon::parse($blog->created_at)->format('M-d-Y'); // Format the created_at date

                return $blog; // Return the modified blog object
            });

       
          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $blogs->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $blogsWithFullImageUrl,
        'version' => $version,
    ]);

    }

    public function getBlogBySlug($slug)
    {
    // Find the blog post by slug
    $blog = Blog::where('slug', $slug)->first();

    $baseUrl = url('/'); // This will give you the base URL of your application

        
            // Map through blogs to include the full image URLs
            // Modify the blog object to include full image URLs and formatted date
    $blog->bImg = $baseUrl . '/storage/' . $blog->cover_image; // Full image URL
    $blog->bcImg = $baseUrl . '/storage/' . $blog->cover_image_resized; // Resized image URL
    $blog->date = Carbon::parse($blog->created_at)->format('M-d-Y'); // Format the created_at date

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404); // Return 404 if not found
        }

        return response()->json($blog); // Return the blog post as JSON
     
    }
    
    public function getFaqs()
    {
        // Fetch partners from the database
        $faqs = FAQ::select('question','answer')->get();
       
          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $faqs->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $faqs,
        'version' => $version,
    ]);

    }

    public function getCounters()
    {
        // Fetch partners from the database
        $counters = Counter::select('years_experience','projects_done','happy_clients','expert_members')->get();
       
          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $counters->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $counters,
        'version' => $version,
    ]);

    }

    public function getTeam()
    {
        // Fetch partners from the database
        $teams = Team::select('name','image','designation','twitter','linkedin')->get();
        $baseUrl = url('/'); 
        $teamsWithFullImageUrl = $teams->map(function ($team) use ($baseUrl) {
            $team->tImg = $baseUrl . '/storage/' . $team->image; // Adjust the path as necessary
            return $team;
        });

          // Get the latest updated_at timestamp to create a dynamic version
    $latestUpdate = $teams->max('updated_at'); // Get the latest updated_at timestamp
    $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

    // Return the services and version as a structured response
    return response()->json([
        'data' => $teamsWithFullImageUrl,
        'version' => $version,
    ]);

    }

    public function getProjects()
    {
         // Fetch partners from the database
         $projects = Project::with(['service' => function($query) {
            $query->select('id', 'title as category'); // Select the id and rename title to category
        }])->get(); // Eager load the service relationship

         // Get the base URL
         $baseUrl = url('/'); // This will give you the base URL of your application

       
           // Map through projects to include the full image URLs
           $projectsWithFullImageUrl = $projects->map(function ($project) use ($baseUrl) {
               $project->bImg = $baseUrl . '/storage/' . $project->cover_image; // Full image URL
               $project->slug = Str::slug($project->title); // Create a slug from the project title
               $project->category = $project->service->category ?? null; // Use the renamed field
               $project->date = Carbon::parse($project->created_at)->format('M-d-Y'); // Format the created_at date

               return $project; // Return the modified blog object
           });

      
         // Get the latest updated_at timestamp to create a dynamic version
   $latestUpdate = $projects->max('updated_at'); // Get the latest updated_at timestamp
   $version = $latestUpdate ? strtotime($latestUpdate) : time(); // Convert to timestamp or use current time if no updates

   // Return the services and version as a structured response
   return response()->json([
       'data' => $projectsWithFullImageUrl,
       'version' => $version,
   ]);

    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
