<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = Team::all();
        return view('admin.team.index', compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'designation', 'twitter', 'linkedin']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team_images', 'public');
            $data['image'] = $path;
        }

        Team::create($data);

        return redirect()->route('team.index')->with('success', 'Team created successfully');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //dd($request->all());

        $team = Team::findOrFail($id);

        $data = $request->only(['name', 'designation', 'twitter', 'linkedin']);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($team->image);
            $data['image'] = $request->file('image')->store('team_images', 'public');
        }

        $team->update($data);

        return redirect()->route('team.index')->with('success', 'Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
