<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;
use App\Models\ChatMessage;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 users
        User::factory(10)->create()->each(function ($user) {
            // For each user, create 3 tasks
            Task::factory(3)->create(['user_id' => $user->id]);
            
            // For each user, create 5 chat messages
            ChatMessage::factory(5)->create(['user_id' => $user->id]);
        });

        // Ensure there's at least one admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
    }
}