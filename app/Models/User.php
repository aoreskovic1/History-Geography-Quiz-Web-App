<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active_at' => 'datetime'
    ];

	public function challenger(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function messages(): HasMany
	{
		return $this->hasMany(ChatMessage::class);
	}

    public function setGame(Game $game)
    {
        $this->game_id = $game->id;
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

	public function setChallenger(?User $user): void
	{
		$this->user_id = $user?->id ?? null;
        $this->save();
	}

    // Returns true if user was active
    // within last 5 minutes
    public function active() {
        return $this->active_at->gt(Carbon::now()->subMinutes(5));
    }

    public function getScore() {
        return $this->total_score;
    }

    public function updateActivity()
    {
        $this->active_at = now();
        $this->save();
    }
}
