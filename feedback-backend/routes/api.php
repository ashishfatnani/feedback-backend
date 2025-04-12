<?php
use App\Http\Controllers\FeedbackController;


Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);