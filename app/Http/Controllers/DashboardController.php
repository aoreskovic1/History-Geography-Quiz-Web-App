<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard form.
     */
    public function index(Request $request): View
    {
        $request->user()->updateActivity();

        $user = $request->user();
        $user->setRememberToken(Str::random(60));
        $user->save();

        return view('dashboard', [
            'users' => User::orderBy('total_score', 'DESC')->get(),
            'messages' => ChatMessage::orderBy('created_at', 'DESC')->limit(10)->get()
        ]);
    }

    public function challenge(Request $request, User $id)
    {
        $id->setChallenger($request->user());

        // If this is 2nd challenge (once someone accepted)
        // create a game and assign both to game
        if($id->id == $id->challenger->user_id) {
            $game = new Game;
            $game->setUserAnswering($id->challenger);
            $game->save();

            $id->setGame($game);
            $id->challenger->setGame($game);
            $id->save();
            $id->challenger->save();
        }

        return json_encode(['status' => 'success']);
    }

    public function statusChallenge(Request $request)
    {
        $user = $request->user();

        if($user->challenger->user_id == $user->id) {
            return json_encode(['status' => 'true']);
        }
        return json_encode(['status' => false]);
    }

    public function denyChallenge(Request $request)
    {
        $request->user()->setChallenger(null);

        return json_encode(['status' => 'success']);
    }

    public function getChallenge(Request $request)
    {
        // return json_encode(Auth::getUser()->challenger);
        if($request->user()->challenger != null){
            return json_encode(['challenger' => $request->user()->challenger]);
        }
        return null;
    }
}
