<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function userAnswering()
    {
        return $this->hasOne(User::class, 'user_answering_id', 'id');
    }

    public function setUserAnswering(?User $user)
    {
        $this->user_answering_id = $user?->id ?? null;
    }
}
