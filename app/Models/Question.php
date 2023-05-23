<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function correct()
    {
        return $this->hasOne(Answer::class, 'correct_answer_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class);
    }
}
