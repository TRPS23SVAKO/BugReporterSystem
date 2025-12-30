<?php

namespace Database\Seeders;

use App\Models\BugStatus;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'id'           => 0,
            'name'         => 'user',
            'display_name' => 'Vartotojas',
            'role_color'   => '6b6b6b' // Pilka
        ]);
        Role::query()->updateOrCreate([
            'id'           => 1,
            'name'         => 'admin',
            'display_name' => 'Administratorius',
            'role_color'   => '4326ff' // Mėlyna
        ]);

        // Sukuriame user
        User::query()->updateOrCreate([
            'id'        => 0,
            'email'     => 'tautvydas.razmantas@gmail.com',
            'password'  => Hash::make('+vz:Vh%En~TeAN7'),
            'role_id'   => 1,
            'is_active' => true,
        ]);

        // Create default settings
        Setting::query()->updateOrCreate([
            'id'          => 0,
            'key'         => 'default_role',
            'value'       => 'user',
            'description' => 'Pradinė rolė, kurią gaus prisijungias nauajs vartotojas.'
        ]);
        Setting::query()->updateOrCreate([
            'id'          => 1,
            'key'         => 'main_page_desc_image',
            'value'       => 'Logo.jpeg',
            'description' => 'Pagrindinio puslapio aprašymo paveikslas'
        ]);
        Setting::query()->updateOrCreate([
            'id'          => 2,
            'key'         => 'main_page_desc_text',
            'value'       => 'Klaidų valdymo sistema – tai internetinė aplikacija, skirta projektų ir programinių klaidų registravimui, stebėjimui bei tvarkymui. Vartotojai gali kurti projektus, priskirti klaidas, sekti jų būsenas, prioritetus ir sprendimo eigą, taip užtikrinant aiškų bendradarbiavimą ir efektyvų darbų valdymą.',
            'description' => 'Pagrindinio puslapio aprašymas'
        ]);

        // Create bug statuses
        BugStatus::query()->updateOrCreate([
            'id'         => 1,
            'key'        => 'open',
            'label'      => 'Atidaryta',
            'sort_order' => 1,
            'color'      => 'DC2626', // raudona
            'is_active'  => true,
        ]);
        BugStatus::query()->updateOrCreate([
            'id'         => 2,
            'key'        => 'in_progress',
            'label'      => 'Vykdoma',
            'sort_order' => 2,
            'color'      => '2563EB', // mėlyna
            'is_active'  => true,
        ]);
        BugStatus::query()->updateOrCreate([
            'id'         => 3,
            'key'        => 'resolved',
            'label'      => 'Išspręsta',
            'sort_order' => 3,
            'color'      => '16A34A', // žalia
            'is_active'  => true,
        ]);
        BugStatus::query()->updateOrCreate([
            'id'         => 4,
            'key'        => 'closed',
            'label'      => 'Uždaryta',
            'sort_order' => 4,
            'color'      => '6B7280', // pilka
            'is_active'  => true,
        ]);
        BugStatus::query()->updateOrCreate([
            'id'         => 5,
            'key'        => 'reopened',
            'label'      => 'Atidaryta iš naujo',
            'sort_order' => 5,
            'color'      => 'F59E0B', // oranžinė
            'is_active'  => true,
        ]);
    }
}
