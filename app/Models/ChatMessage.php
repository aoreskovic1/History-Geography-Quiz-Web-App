<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message'
    ];


	public function author(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setAuthor(User $user)
    {
        $this->user_id = $user->id;
    }
}
