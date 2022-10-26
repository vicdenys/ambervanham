<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Amber van Ham',
            'email' => 'vanhamamber@gmail.com',
            'password' => Hash::make('ambervanham')
        ]);

        $this->call([
            CategorySeeder::class,
            FileSeeder::class,
            ExhibitionSeeder::class,
        ]);
    }
}
