<?php

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 20; $i++) {
            $user = User::inRandomOrder()->first();

            $message = new ChatMessage();

            $message->setAuthor($user);
            $message->setMessage("Hello world!");
            $message->save();
        }
    }
}
