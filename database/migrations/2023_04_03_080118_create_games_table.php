<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('last_question')->default(0);

            $table->foreignId('user_answering_id')->nullable();
            $table->foreign('user_answering_id')->references('id')->on('users')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table)
        {
            $table->foreignId('game_id')->nullable();
            $table->foreign('game_id')->references('id')->on('games')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
