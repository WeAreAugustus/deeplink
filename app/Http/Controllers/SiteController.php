<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Site;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::all();
        return view('dashboard.sites.index', compact('sites'));
    }

    public function create()
    {
        return view('dashboard.sites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sites',
            'android_link' => 'required|url',
            'ios_link' => 'required|url',
            'web_link' => 'required|url',
        ]);

        Site::create($request->all());
        return redirect()->route('dashboard.sites.index')->with('success', 'Site created!');
    }
    public function edit($id)
    {
        $site = Site::findOrFail($id);
        return view('dashboard.sites.edit', compact('site'));
    }

    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'android_link' => 'nullable|url',
            'ios_link' => 'nullable|url',
            'web_link' => 'nullable|url',
            'api_key' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active');
        $site->update($validated);
        return redirect()->route('dashboard.sites.index')->with('success', 'Site updated successfully.');
    }
}

