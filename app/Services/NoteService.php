<?php

namespace App\Services;

use App\Models\Note;
use Illuminate\Support\Facades\DB;

/**
 * Class NoteService.
 */
class NoteService
{
public function createNote(array $request): Note
    {
        // Implement the logic to create a note using the provided data
        // For example, you can use Eloquent to create a new Note model instance
        // and save it to the database.

        return DB::transaction(function () use ($request) {
            $note = new Note();
            $note->user_id = $request['user_id'];
            $note->topic_id = $request['topic_id'];
            $note->title = $request['title'];
            $note->content = $request['content'];
            $note->visibility = $request['visibility'] ?? 'private'; // Default to private if not provided
            $note->status = $request['status'] ?? 'draft'; // Default to draft if not provided
            $note->published_at = $request['published_at'] ?? null;
            $note->archived_at = $request['archived_at'] ?? null;
            $note->save();

            return $note;
        });
   
    }

    public function getmynote(int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return Note::where('user_id', $userId)->get();
    }

    public function getNoteById(int $noteId): ?Note
    {
        return Note::find($noteId);
    }
    public function RetrieveNotePublic(int $noteId): ?Note
    {
        return Note::where('id', $noteId)
            ->where('visibility', 'public')
            ->first();
    }

    public function getAllPublicNotes(): \Illuminate\Database\Eloquent\Collection
    {
        return Note::where('visibility', 'public')->get();
    }
    
    public function UpdatesNote(int $noteId, int $userId, array $data): ?Note
    {
        $note = Note::where('id', $noteId)
            ->where('user_id', $userId)
            ->first();
        
        unset($data['user_id']); // Prevent changing the user_id
        if ($note) {
            $note->update($data);
        }

        return $note;
    }

    public function deleteNote(int $noteId, int $userId): bool
    {
        $note = Note::where('id', $noteId)
            ->where('user_id', $userId)
            ->first();

        $note->delete();
        return true;
    }
}
