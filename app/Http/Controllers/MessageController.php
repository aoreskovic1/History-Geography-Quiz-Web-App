<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ChatMessage;
use App\Models\Game;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = $request->user();
        $message = $request->message;

        $new = $user->messages()->create([
            'message' => $message
        ]);

        return json_encode($new);
    }
    public function getMessages(Request $request)
    {
        $messages = ChatMessage::orderBy('created_at', 'DESC')->with('author')->limit(10)->get();

        return json_encode($messages->toArray());
    }
}
