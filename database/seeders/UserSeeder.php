<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // HEADCLIFF USER
        $headcliff = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Chak Mahmood',
                'email_verified_at' => now(),
                'password' => bcrypt('Gakngotak26'), // Ganti password untuk produksi
            ]
        );
        $headcliff->syncRoles(['super_admin']);

    }
}
