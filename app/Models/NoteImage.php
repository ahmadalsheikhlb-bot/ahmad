<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'path',
        'alt_text',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
