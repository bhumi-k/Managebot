<?php

namespace Database\Factories;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatMessageFactory extends Factory
{
    protected $model = ChatMessage::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'message' => $this->faker->sentence,
            'is_bot' => $this->faker->boolean(20), // 20% chance of being a bot message
        ];
    }
}