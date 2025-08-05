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
        return redirect()->route('sites.index')->with('success', 'Site created!');
    }
}

