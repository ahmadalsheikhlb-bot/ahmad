<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/change-password', [AuthController::class, 'changePassword']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });
     Route::middleware('note-ownership')->group(function ()
      {
route::get('/mynotes/{userId}', [NoteController::class, 'mynotes']);
route::get('retrieveAllPublicNotes', [NoteController::class, 'index']);
route::get('retrievePublicNote/{noteId}', [NoteController::class, 'show']);
route::get('specificnote/{noteId}/{userId}', [NoteController::class, 'getNoteById']);
route::post('createNote', [NoteController::class, 'store']);
route::post('updatenote/{noteId}/{userId}', [NoteController::class, 'update']);
route::delete('deletenote/{noteId}/{userId}', [NoteController::class, 'delete']);    
    });
});

