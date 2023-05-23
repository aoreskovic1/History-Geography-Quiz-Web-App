<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Game;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    /**
     * Display the user's dashboard form.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user->updateActivity();

        if($user?->challenger?->challenger?->id != $user->id) {
            return redirect(route('dashboard'));
        }

        return view('game', [
            'name' => $user?->challenger->name,
        ]);
    }

    public function finish(Request $request)
    {
        return view('game-finish', [
            'challenger' => $request->user()?->challenger,
            'user' => $request->user()
        ]);
    }

    // Process the game
    // add scores, remove game_score, remove challenger, remove game
    public function done(Request $request)
    {
        $user = $request->user();

        try{
            $user->challenger->user_id = null;
            $user->challenger->save();
        }
        catch(Exception $e) {}

        $user->total_score += $user->game_score;
        $user->game_score = 0;
        $user->user_id = null;
        $user->save();

        return redirect(route('dashboard'));
    }

    public function question(Request $request)
    {
        $game = $request->user()->game;

        try{
            $question = $game->questions[$game->last_question / 2];

            if($request->user()->user_id == null) throw new Exception;
        }
        catch(Exception $e) {
            return json_encode([
                'game' => [
                    'finished' => true
                    ]
            ]);
        }

        // hide correct answer from response, do not save this change to db!
        $question->correct_answer_id = null;

        if($game->user_answering_id == $request->user()->id) {
            return json_encode(['question' => $question, 'answers' => $question->answers]);
        }
        return null;
    }

    public function answer(Request $request, Answer $id)
    {
        $user = $request->user();

        if($user->id != $user->game->user_answering_id) {
            return null;
        }

        $user->game->last_question += 1;
        $user->game->user_answering_id = $user->user_id;
        $user->game->save();

        $response = ($id->question->correct_answer_id == $id->id);

        $points = 0;

        // Add 1 point for correct
        // remove 0.5 for incorrect
        if($response) $points = 1;
        else $points = -0.5;

        $user->game_score += $points;
        $user->save();

        return json_encode(['correct' => $response]);
    }
}
