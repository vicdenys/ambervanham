<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::factory()
            ->count(30)
            ->create();


        // Get all the roles attaching up to 3 random roles to each user
        $categories = Category::all();

        // Populate the pivot table
        File::all()->each(function ($file) use ($categories) {
            $file->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
