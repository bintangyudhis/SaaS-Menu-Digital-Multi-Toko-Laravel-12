<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // database seeder adalah tempat memanggil seeder
    // untuk menjalankannya ketik php artisan db:seed di terminal
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
