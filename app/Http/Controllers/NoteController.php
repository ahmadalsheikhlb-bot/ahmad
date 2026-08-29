<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Services\NoteService;
//use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(private NoteService $noteService)
    {
       
    }
    public function index()//retrieve all public notes
    {
        $notes = $this->noteService->getAllPublicNotes();
        return response()->json($notes);
    }


    public function show(int $noteId)//returieve a specific public note
    {
        $note = $this->noteService->RetrieveNotePublic($noteId);
        if (!$note) {
            return response()->json(['message' => 'Note not found or not public'], 404);
        }
        return response()->json($note);
    }
    public function mynotes(int $userId)//retrieve all notes of a specific user
    {
        $notes = $this->noteService->getmynote($userId);
        return response()->json($notes);
    }
    public function getNoteById(int $noteId, int $userId)//retrieve a specific note of a specific user
    {
        $note = $this->noteService->getNoteById($noteId);
        if (!$note || $note->user_id !== $userId) {
            return response()->json(['message' => 'Note not found or does not belong to the user'], 404);
        }
        return response()->json($note);
    }
   public function store(CreateNoteRequest $request)//create a new note
   {
      $data=$request->validated();
      $this->noteService->createNote($data);
   }
   public function update(int $noteId, int $userId, CreateNoteRequest $request)//update a specific note of a specific user
   {
      $data=$request->validated();
      $note = $this->noteService->UpdatesNote($noteId, $userId, $data);
      if (!$note) {
         return response()->json(['message' => 'Note not found or does not belong to the user'], 404);
     }
     return response()->json($note);
   }
   public function delete(int $noteId, int $userId){
    
      $note = $this->noteService->deleteNote($noteId, $userId);
      if (!$note) {
         return response()->json(['message' => 'Note not found or does not belong to the user'], 404);
     }
     return response()->json(['message' => 'Note deleted successfully']);
   }//delete a specific note of
}
