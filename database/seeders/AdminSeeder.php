<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;   

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    //seeder =pengisian isi database
    public function run(): void
    {
        User::create([
            'logo' => 'default.jpg',
            'name' => 'Admin Emenu',
            'username' => 'admin',
            'email' => 'admin@emenu.com',
            'password' => bcrypt(123),
            'role' => 'admin'
        ]);
    }
}
