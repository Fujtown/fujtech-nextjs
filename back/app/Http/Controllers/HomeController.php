<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Partner;
use App\Models\PricingTable;
use App\Models\Project;
use App\Models\Services;
use App\Models\Subscriber;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;

class HomeController extends Controller
{
    public function index()
    {
        
        $partners = Partner::all();
        $services = Services::all(); 
        $allProjects = Project::all();
        $pricingTables = PricingTable::all();
        $counter = Counter::first();
        $clients = Client::all();
        $contacts = Contact::all();
        $categories = Category::all();  
        $team = Team::all();
        $blogPosts = Blog::with('category')->latest()->take(3)->get();
        return view('home', compact('partners', 'services', 'allProjects', 'pricingTables', 'counter', 'clients', 'contacts', 'categories', 'blogPosts', 'team'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = Subscriber::create($request->all());

        Mail::to($request->email)->send(new SubscriptionConfirmation($subscriber));
        return response()->json(['success' => true, 'message' => 'Subscription successful!']);
    }
}
