<?php

namespace Database\Seeders;

use App\Models\PageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $page_types = [
            ['name'=>'Single Content'],
            ['name'=>'Multiple Content'],
            ['name'=>'Blog'],
            ['name'=>'Gallery']
        ];

        collect($page_types)->each(function($type){
            PageType::create($type);
        });
    }
}
