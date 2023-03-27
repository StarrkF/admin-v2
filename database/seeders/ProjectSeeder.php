<?php

namespace Database\Seeders;

use App\Models\Project;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        $data = [];
        for ($i = 0; $i < 1000000; $i++) {
            $data[] = [
                'company_id' => rand(1, 100000),
                'name' => $faker->sentence(4, true),
                'detail' => $faker->paragraph(3, true),
                'budget' => $faker->numberBetween(1000, 100000),
                'status' => $faker->randomElement(['in_progress', 'completed', 'cancelled']),
                'notes' => $faker->text(200),
            ];
            echo $i % 50000 == 0 ? $i. "\n" : "";
        }
        echo "Array created! \n\n";
        $chunks = array_chunk($data, 10000);
        foreach ($chunks as $index=>$chunk) {
            Project::query()->insert($chunk);
            echo (++$index*10)."k Records created!\n";
        }
    }
}
