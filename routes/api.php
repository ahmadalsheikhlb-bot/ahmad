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
    
     Route::middleware(['note-ownership','auth:sanctum'])->group(function ()
      {
route::get('/mynotes/{noteId}', [NoteController::class, 'mynotes']);
route::get('retrieveAllPublicNotes', [NoteController::class, 'index']);
route::get('retrievePublicNote/{noteId}', [NoteController::class, 'show']);
route::get('specificnote/{noteId}/{userId}', [NoteController::class, 'getNoteById']);
route::post('createNote', [NoteController::class, 'store']);
route::post('updatenote/{noteId}/{userId}', [NoteController::class, 'update']);
route::delete('deletenote/{noteId}', [NoteController::class, 'delete']);  
route::post('replaceimage/{oldpath}/{Foldername}', [NoteController::class, 'REplaceImage']);  
route::delete('deletenoteimage/{path}', [NoteController::class, 'DEleteImage']);
route::post('uploadimage/{Foldernamegit}', [NoteController::class,'AddImage']);
    });
});

