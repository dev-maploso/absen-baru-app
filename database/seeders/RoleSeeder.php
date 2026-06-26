<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar role
        $roles = [
            'super_admin',
            'superadmin',
            'admin',
            'dosen',
            'mahasiswa',
        ];

        // Buat roles jika belum ada
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        // Ambil semua permission yang sudah dibuat oleh Shield
        $permissions = Permission::pluck('name')->toArray();
    }
}
