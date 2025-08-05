<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ShortLinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::post('/generate', [ShortLinkController::class, 'generate']);

// Welcome route
Route::get('/', function () {
    return view('welcome');
});

// ✅ Debug DB connection
Route::get('/debug-db', function () {
    try {
        DB::connection()->getPdo();
        return [
            'ENV' => env('DB_HOST'),
            'CONFIG' => config('database.connections.mysql.host'),
            'Connected' => true
        ];
    } catch (\Exception $e) {
        return [
            'ENV' => env('DB_HOST'),
            'CONFIG' => config('database.connections.mysql.host'),
            'Connected' => false,
            'Error' => $e->getMessage()
        ];
    }
});

// ⚠️ This must come LAST — it's a catch-all route!
Route::get('/{code}', [ShortLinkController::class, 'redirect']);
