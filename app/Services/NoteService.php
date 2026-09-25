<?php

namespace App\Services;

use App\HasFile;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\NoteImage;
use Illuminate\Http\UploadedFile;
//use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateNoteRequest;
use Illuminate\Support\Facades\Auth;
/**
 * Class NoteService.
 */
class NoteService
{
    use HasFile;

    public function createNote(CreateNoteRequest $request): Note
    {
        // Implement the logic to create a note using the provided data
        // For example, you can use Eloquent to create a new Note model instance
        // and save it to the database.
        $this->Storefiles($request->file('images'), 'note_images');
        return DB::transaction(function () use ( $request) {
            $data = $request->validated();
            $note = Note::create($data);
            return $note;
          
        });
   
    }

    //user retrives their own notes
    public function getmynote(int $noteId): Note
    {
       $note=Note::where('id',$noteId)
       ->where('user_id',auth()->id())
       ->firstOrFail();
       return $note;
    }

    public function getNoteById(int $noteId): ?Note
    {
         $note=Note::where('id',$noteId)->first();
         return $note;
    }
    public function RetrieveNotePublic(int $noteId): ?Note
    {
       $note=Note::where('id', $noteId)
            ->where('visibility', 'public')
            ->first();
            return $note;
    }

    public function getAllPublicNotes(): \Illuminate\Database\Eloquent\Collection
    {
        $note= Note::where('visibility', 'public')->get();
        return $note;
    }
    
    public function UpdatesNote(int $noteId, int $userId, UpdateNoteRequest $request): ?Note
    {
        $data=$request->validated();
        $note = Note::where('id', $noteId)
            ->where('user_id', $userId)
            ->first();
        
        unset($data['user_id']); // Prevent changing the user_id
        if ($note) {
            $note->update($data);
        }

        return $note;
    }

    public function deleteNote(int $noteId): bool
    {
        $note = Note::where('id', $noteId)
            ->where('user_id', auth()->user()->id)
            ->first();

        $note->delete();
        return true;
    }

    public function DeleteImage(string $path): bool
    {
       $this->DeleteFiles($path);
         return true; 
    }

    public function ReplaceImage(string $oldpath, CreateNoteRequest $request, string $Foldername)
    {
        $newfile = $request->file('images');
        $this->ReplaceFiles($oldpath, $newfile, $Foldername);
        return true;    
    }

    public function AddImage(CreateNoteRequest $request, string $Foldername)
    {
        $file = $request->file('images');
        $this->StoreFiles($file, $Foldername);
        return true;
    }
}
