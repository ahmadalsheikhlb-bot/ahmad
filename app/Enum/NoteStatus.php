<?php

namespace App\Enum;

enum NoteStatus : string
{
    case Draft='draft';
    case PUBLISHED= 'published';
    case ARCHIVED= 'archived';
}
