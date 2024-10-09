<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PricingTableController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\HomeController;


Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// All admin routes protected by custom middleware
Route::middleware(['admin'])->prefix('coffee')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('admin.home');

    // Blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/add-blog', [BlogController::class, 'create'])->name('add-blog');
    Route::post('/store-blog', [BlogController::class, 'store'])->name('store-blog');
    Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit-blog');
    Route::put('/update-blog/{id}', [BlogController::class, 'update'])->name('update-blog');
    Route::delete('/delete-blog/{id}', [BlogController::class, 'destroy'])->name('delete-blog');
    Route::resource('blogs', BlogController::class)->except(['create', 'index', 'store', 'edit', 'update', 'destroy']);

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('store-category');
    Route::put('/update-category/{category}', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::resource('categories', CategoryController::class)->except(['create', 'index', 'store', 'update', 'destroy']);

    // Service routes
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/add-service', [ServiceController::class, 'create'])->name('add-service');
    Route::post('/store-service', [ServiceController::class, 'store'])->name('store-service');
    Route::put('/update-service/{service}', [ServiceController::class, 'update'])->name('update-service');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    Route::resource('services', ServiceController::class)->except(['create', 'index', 'store', 'update', 'destroy']);

    // Project routes
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/add-project', [ProjectController::class, 'create'])->name('add-project');
    Route::post('/store-project', [ProjectController::class, 'store'])->name('store-project');
    Route::get('/edit-project/{id}', [ProjectController::class, 'edit'])->name('edit-project');
    Route::put('/update-project/{project}', [ProjectController::class, 'update'])->name('update-project');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::resource('projects', ProjectController::class)->except(['create', 'index', 'store', 'update', 'destroy']);

    // Contact routes
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store-contact', [ContactController::class, 'store'])->name('store-contact');
    Route::resource('contact', ContactController::class)->except(['index', 'store']);

    // Pricing Table routes
    Route::get('/pricing-table', [PricingTableController::class, 'index'])->name('pricing-table.index');
    Route::post('/store-pricing-table', [PricingTableController::class, 'store'])->name('store-pricing-table');
    Route::get('/add-pricing-table', [PricingTableController::class, 'create'])->name('add-pricing-table');
    Route::get('/edit-pricing-table/{id}', [PricingTableController::class, 'edit'])->name('edit-pricing-table');
    Route::put('/update-pricing-table/{id}', [PricingTableController::class, 'update'])->name('update-pricing-table');
    Route::delete('/delete-pricing-table/{id}', [PricingTableController::class, 'destroy'])->name('delete-pricing-table');
    Route::resource('pricing-table', PricingTableController::class)->except(['index', 'store', 'create', 'edit', 'update', 'destroy']);

    // Counter routes
    Route::get('/counter', [CounterController::class, 'index'])->name('counter.index');
    Route::post('/store-counter', [CounterController::class, 'store'])->name('store-counter');
    Route::resource('counter', CounterController::class)->except(['index', 'store']);

    // Clients routes
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/add-client', [ClientController::class, 'create'])->name('add-client');
    Route::post('/store-client', [ClientController::class, 'store'])->name('store-client');
    Route::resource('clients', ClientController::class)->except(['index', 'store']);

    // About routes
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/store-about', [AboutController::class, 'store'])->name('store-about');
    Route::resource('about', AboutController::class)->except(['index', 'store']);

    // Partners routes
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/add-partner', [PartnerController::class, 'create'])->name('add-partner');
    Route::post('/store-partner', [PartnerController::class, 'store'])->name('store-partner');
    Route::get('/edit-partner/{id}', [PartnerController::class, 'edit'])->name('edit-partner');
    Route::put('/update-partner/{id}', [PartnerController::class, 'update'])->name('update-partner');
    Route::delete('/delete-partner/{id}', [PartnerController::class, 'destroy'])->name('delete-partner');
    Route::resource('partners', PartnerController::class)->except(['index', 'store', 'edit', 'update', 'destroy']);

    // Team routes
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/add-team', [TeamController::class, 'create'])->name('add-team');
    Route::post('/store-team', [TeamController::class, 'store'])->name('store-team');
    Route::get('/edit-team/{id}', [TeamController::class, 'edit'])->name('edit-team');
    Route::put('/update-team/{id}', [TeamController::class, 'update'])->name('update-team');
    Route::delete('/delete-team/{id}', [TeamController::class, 'destroy'])->name('delete-team');
    Route::resource('team', TeamController::class)->except(['index', 'store', 'edit', 'update', 'destroy']);

    
    // FAQ routes
    Route::get('/faq', [FAQController::class, 'index'])->name('faq.index');
    Route::get('/add-faq', [FAQController::class, 'create'])->name('add-faq');
    Route::post('/store-faq', [FAQController::class, 'store'])->name('store-faq');
    Route::get('/edit-faq/{id}', [FAQController::class, 'edit'])->name('edit-faq');
    Route::put('/update-faq/{id}', [FAQController::class, 'update'])->name('update-faq');
    Route::delete('/delete-faq/{id}', [FAQController::class, 'destroy'])->name('delete-faq');
    Route::resource('faq', FAQController::class)->except(['index', 'store', 'edit', 'update', 'destroy']);



    // Logout route
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



