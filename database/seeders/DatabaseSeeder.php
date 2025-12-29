<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Sukuriame rolės
        Role::query()->updateOrCreate([
            'id' => 0,
            'name' => 'user',
            'display_name' => 'Vartotojas',
            'role_color' => '6b6b6b' // Pilka
        ]);
        Role::query()->updateOrCreate([
            'id' => 1,
            'name' => 'admin',
            'display_name' => 'Administratorius',
            'role_color' => '4326ff' // Mėlyna
        ]);

        // Create default settings
        Setting::query()->updateOrCreate([
            'id' => 0,
            'key' => 'default_role',
            'value' => 'user',
            'description' => 'Pradinė rolė, kurią gaus prisijungias nauajs vartotojas.'
        ]);
        Setting::query()->updateOrCreate([
            'id' => 1,
            'key' => 'main_page_desc_image',
            'value' => 'Logo.jpeg',
            'description' => 'Pagrindinio puslapio aprašymo paveikslas'
        ]);
        Setting::query()->updateOrCreate([
            'id' => 2,
            'key' => 'main_page_desc_text',
            'value' => 'Klaidų valdymo sistema – tai internetinė aplikacija, skirta projektų ir programinių klaidų registravimui, stebėjimui bei tvarkymui. Vartotojai gali kurti projektus, priskirti klaidas, sekti jų būsenas, prioritetus ir sprendimo eigą, taip užtikrinant aiškų bendradarbiavimą ir efektyvų darbų valdymą.',
            'description' => 'Pagrindinio puslapio aprašymas'
        ]);
    }
}
