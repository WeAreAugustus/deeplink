<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::with('site')->latest()->get();
        return view('dashboard.short_links.index', compact('shortLinks'));
    }

    public function create()
    {
        $sites = Site::whereIsActive(1)->get();
        return view('dashboard.short_links.create', compact('sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:short_links',
            'web' => 'nullable|string',
            'site_id' => 'required|exists:sites,id',
            'item_type' => 'required|string',
            'item_value' => 'required|string',
        ]);

        $details = json_encode([
            'item_type' => $request->item_type,
            'item_value' => $request->item_value,
        ]);

        ShortLink::create([
            'code' => $request->code,
            'web' => $request->web,
            'site_id' => $request->site_id,
            'details' => $details,
        ]);

        return redirect()->route('short-links.index')->with('success', 'Short link created!');
    }
    public function generate(Request $request)
    {
        $request->validate([
            'web' => 'nullable|string',
            'item_type' => 'required|string',
            'item_value' => 'required|string',
        ]);
        $apiKey = $request->header('x-api-key');
        $site = Site::where('api_key', $apiKey)->first();
        if (!$apiKey || !$site) {
            return response()->json(['success' => false,'message' => 'Unauthorized. Invalid API key.'], 401);
        }
        do {
            $code = Str::random(6);
        } while (ShortLink::where('code', $code)->exists());

        $details = json_encode([
            'item_type' => $request->item_type,
            'item_value' => $request->item_value,
        ]);
        ShortLink::create([
            'code' => $code,
            'web' => $request->web,
            'site_id' => $site->id,
            'details' => $details,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Successfully created short link.',
            'short_url' => url($code),
            'code' => $code,
        ]);
    }
    public function redirect(Request $request, $code)
    {
        // Get the short link with its related site
        $link = ShortLink::with('site')->where('code', $code)->firstOrFail();

        $site = $link->site;

        if (!$site) {
            abort(404, 'Associated site not found.');
        }

        $agent = $request->header('User-Agent');

        // Redirect based on device type
        if (stripos($agent, 'iPhone') !== false || stripos($agent, 'iPad') !== false) {
            return redirect($site->ios_link);
        } elseif (stripos($agent, 'Android') !== false) {
            return redirect($site->android_link);
        } else {
            return redirect($site->web_link. $link->web);
        }
    }
    public function details(Request $request, $code)
    {
        $link = ShortLink::where('code', $code)->first();
        if (!$link) {
            return response()->json(['success' => false,'message' => 'Code not found'], 404);
        }
        return response()->json(json_decode($link->details, true));
    }

}
