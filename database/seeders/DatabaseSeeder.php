<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles terlebih dahulu (hanya insert jika belum ada)
        // DB::table('role')->insertOrIgnore([
        //     ['id' => 1, 'name' => 'Admin'],
        //     ['id' => 2, 'name' => 'User'],
        // ]);

        // User::factory(50)->create();
        Peserta::factory(50)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
