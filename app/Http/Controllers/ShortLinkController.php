<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'android_link' => 'required|url',
            'ios_link' => 'required|url',
            'web_link' => 'required|url',
        ]);

        $code = Str::random(6);

        $link = ShortLink::create([
            'code' => $code,
            'android_link' => $validated['android_link'],
            'ios_link' => $validated['ios_link'],
            'web_link' => $validated['web_link'],
        ]);

        return response()->json(['short_url' => url($code)]);
    }

    public function redirect(Request $request, $code)
    {
        $link = ShortLink::where('code', $code)->firstOrFail();

        $agent = $request->header('User-Agent');

        if (stripos($agent, 'iPhone') !== false || stripos($agent, 'iPad') !== false) {
            return redirect($link->ios_link);
        } elseif (stripos($agent, 'Android') !== false) {
            return redirect($link->android_link);
        } else {
            return redirect($link->web_link);
        }
    }
}
