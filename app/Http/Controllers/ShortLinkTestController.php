<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkTestController extends Controller
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

//    function encryptShortData(array $data): string
//    {
//        $json = json_encode($data);
//
//        // مفتاح تشفير 16 بايت (AES-128) - يجب مشاركته مع تطبيق الموبايل
//        $key = substr(hash('sha256', 'your-secret-key'), 0, 16);
//
//        // لاستخدام بدون IV ثابت (أقل أمانًا ولكن أقصر ناتج)
//        $cipher = 'AES-128-ECB';
//        $encrypted = openssl_encrypt($json, $cipher, $key, OPENSSL_RAW_DATA);
//
//        // ترميز base64 مع تقصير الناتج
//        return rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
//    }
    public function encrypt(Request $request)
    {
        $validated = $request->validate([
            'android_link' => 'required|url',
            'ios_link' => 'required|url',
            'web_link' => 'required|url',
        ]);
        $json = json_encode($validated);
        $key = substr(hash('sha256', 'AugustusMedia'), 0, 16); // AES-128
        $cipher = 'AES-128-ECB';
        $encrypted = openssl_encrypt($json, $cipher, $key, OPENSSL_RAW_DATA);
        $code = rtrim(strtr(base64_encode($encrypted), '+/', '-_'), '=');
        $link = ShortLink::create([
            'code' => $code,
            'android_link' => $validated['android_link'],
            'ios_link' => $validated['ios_link'],
            'web_link' => $validated['web_link'],
        ]);
        return response()->json([
            'code' => $code
        ]);
    }
}
