<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 100000 ; $i++) {
            Company::create([
                'name' => $faker->company,
                'address' => $faker->streetAddress,
                'street' => $faker->state,
                'postcode' => $faker->postcode,
                'country' => $faker->country,
                'phoneNumber' => $faker->phoneNumber,
                'companyEmail' => $faker->companyEmail
            ]);

            $i%5000 == 0 ? dump($i) : '';
        }
    }
}
