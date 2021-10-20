<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = Setting::create([
            'title' => 'shatla',
            'sub_title' => '',
            'twitter_url' => 'https://twitter.com',
            'instagram_url' => 'https://intagram.com',
            'facebook_url' => 'https://facebook.com',
            'contact_number' => '0592665857',
        ]);
    }
}
