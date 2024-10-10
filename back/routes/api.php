<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\APIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Define a route for fetching partners
Route::get('/partners', [APIController::class, 'getPartners']);

Route::get('/services', [APIController::class, 'getServices']);
Route::get('/faqs', [APIController::class, 'getFaqs']);
Route::get('/blogs_limit', [APIController::class, 'getBlogsLimit']);
Route::get('/blogs', [APIController::class, 'getBlogs']);
Route::get('/counters', [APIController::class, 'getCounters']);
Route::get('/team', [APIController::class, 'getTeam']);
// New route for fetching a single blog by slug
Route::get('/blogs/{slug}', [APIController::class, 'getBlogBySlug']); // Add this line

// Define a route for fetching projects
Route::get('/projects', [APIController::class, 'getProjects']);
Route::get('/categories', [APIController::class, 'getCategories']);