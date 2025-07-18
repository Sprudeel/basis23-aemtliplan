<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Sueno',
            'email' => 'aemtli@risola25.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$20WUyv9KKMOZr7h7PE0d/uy12yQdYb87hHI7688r02g/k.QldAq7i'
        ]);
    }
}
