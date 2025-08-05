<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Url Admin',
             'email' => 'admin@urls.augustusmedia.com',
             'password' => bcrypt('Admin@13579'), // Ensure to use a secure password
         ]);

        Site::insert([
            [
                'name' => 'Smashi',
                'android_link' => 'https://play.google.com/store/apps/details?id=com.augustus.smashi&pli=1',
                'ios_link' => 'https://apps.apple.com/eg/app/smashi/id1497697949?platform=iphone',
                'web_link' => 'https://smashi.tv/',
                'api_key' => Str::random(16),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lovin',
                'android_link' => 'https://play.google.com/store/apps/details?id=co.lovin.lovinapp&hl=en&gl=US',
                'ios_link' => 'https://apps.apple.com/in/app/lovin-augustus-media/id1529508280',
                'web_link' => 'https://lovin.co/',
                'api_key' => Str::random(16),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
