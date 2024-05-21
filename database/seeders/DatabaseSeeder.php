<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => fake()->name(),
            'email' => fake()->userName().'@gmail.com',
            'username' => fake()->unique()->userName(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'is_active' => 1,
            'role' => 'admin',
        ]);
        User::factory(9)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Post::factory(11)->create();
        Comment::factory(33)->create();
    }
}
