<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'M.Furkan Aymegen',
        //     'email' => 'furkan@mail.com',
        //     'password' => '12345678',
        // ]);

        for ($i=1; $i <= 50; $i++) {
            Category::create([
                'name' => 'category '.$i,
                'slug' => 'category '.$i,
                'number' => $i,
                'page_type_id' => rand(1, 4),
            ]);
        }

    }
}
