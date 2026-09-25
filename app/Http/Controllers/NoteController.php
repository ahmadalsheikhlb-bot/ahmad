<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Services\NoteService;
use App\UnifiedResponse;
use Illuminate\Http\UploadedFile;
//use Illuminate\Http\Request;

class NoteController extends Controller
{
    use UnifiedResponse;
    public function __construct(private NoteService $noteService)
    {
       
    }
    //Done2
    public function index()//retrieve all public notes
    {
        try {
           $notes = $this->noteService->getAllPublicNotes();
       return $this->SuccessResponse($notes);
        } catch (\Throwable $th) {
           return $this->ErrordResponse();
        }
       
    }

//Done7
    public function show(int $noteId)//returieve a specific public note
    {

    try {
        $note = $this->noteService->RetrieveNotePublic($noteId);
         return $this->SuccessResponse( $note);
    } catch (\Throwable $th) {
       return $this->ErrordResponse();
    }

    }

   //Done3
    public function mynotes(int $noteId)//retrieve all notes of a specific user
    {
        try {
             $notes = $this->noteService->getmynote($noteId);
             return $this->SuccessResponse($notes);
        } catch (\Throwable $th) {
            return $this->ErrordResponse();
        }
       
        
    }
    //Done4
    public function getNoteById(int $noteId)//retrieve a specific note of a specific user
    {

    try {
       $note = $this->noteService->getNoteById($noteId);
        return $this->SuccessResponse($note);
    } catch (\Throwable $th) {
         return $this->ErrordResponse();
    }
    }
    //Done NUmber 1
   public function store(CreateNoteRequest $request)//create a new note
   {
    try {
       $note= $this->noteService->createNote($request);
        return $this->SuccessResponse($note);
    } catch (\Throwable $th) {
       return $this->ErrordResponse();
    }
   }
   //Done5
   public function update(int $noteId, int $userId, UpdateNoteRequest $request)//update a specific note of a specific user
   {
      try {
       $note = $this->noteService->UpdatesNote($noteId, $userId, $request);
        return $this->SuccessResponse($note);
      } catch (\Throwable $th) {
       return $this->ErrordResponse();
      }

   }
   //Done6
   //delete a specific note of
   public function delete(int $noteId){
    
   try {
   $note = $this->noteService->deleteNote($noteId);
    return $this->SuccessResponse();
   } catch (\Throwable $th) {
     return $this->ErrordResponse();
   }}

   // functions with UnifiedResponseTrait
   public function DEleteImage(string $path)
   {
      try {
        $this->noteService->DeleteImage($path);
        return $this->SuccessResponse();
      } catch (\Throwable $th) {
        return $this->ErrordResponse();
      }
   }
   public function REplaceImage(string $oldpath, UploadedFile $newfile, string $Foldername)
   {
      try {
        $this->noteService->ReplaceImage($oldpath, $newfile, $Foldername);
        return $this->SuccessResponse();
      } catch (\Throwable $th) {
        return $this->ErrordResponse();
      }
   }

   public function AddImage(UploadedFile $file, string $Foldername)
   {
      try {
        $this->noteService->AddImage($file, $Foldername);
        return $this->SuccessResponse();
      } catch (\Throwable $th) {
        return $this->ErrordResponse();
      }
   }
}
