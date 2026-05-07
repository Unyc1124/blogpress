<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;

use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            'Web Development',

            'Mobile Development',

            'Cybersecurity',

            'Cloud Computing',

            'UI UX Design',

            'Programming',

            'DevOps',

            'Data Science',

            'Startups',

            'Productivity',

            'Career',

            'Open Source',

            'Blockchain',
        ];

        foreach ($categories as $category) {

            Category::create([

                'name' => $category,

                'slug' => Str::slug($category),
            ]);
        }
    }
}