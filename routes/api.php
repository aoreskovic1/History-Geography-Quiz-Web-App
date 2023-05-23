<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(AuthMiddleware::class)->post('/challenge/{id}', [DashboardController::class, 'challenge'])->name('challenge');
Route::middleware(AuthMiddleware::class)->get('/me/challenges', [DashboardController::class, 'getChallenge'])->name('getChallenge');
Route::middleware(AuthMiddleware::class)->post('/me/challenges/deny', [DashboardController::class, 'denyChallenge'])->name('getChallenge');
Route::middleware(AuthMiddleware::class)->post('/me/challenges/status', [DashboardController::class, 'statusChallenge'])->name('getChallenge');
Route::middleware(AuthMiddleware::class)->get('/me/question', [GameController::class, 'question'])->name('getQuestion');
Route::middleware(AuthMiddleware::class)->post('/game/answer/{id}', [GameController::class, 'answer'])->name('answerQuestion');
Route::middleware(AuthMiddleware::class)->get('/messages/get', [MessageController::class, 'getMessages'])->name('getMessages');
Route::middleware(AuthMiddleware::class)->post('/message/send', [MessageController::class, 'sendMessage'])->name('sendMessage');


