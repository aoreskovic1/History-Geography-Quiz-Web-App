<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Question;

class GameObserver
{
    /**
     * Handle the Game "created" event.
     */
    public function created(Game $game): void
    {
        // Get 10 random questions
        $questions = Question::distinct()->inRandomOrder()->limit(10)->get();

        // Associate questions with game
        $game->questions()->sync($questions);
    }
}
