<?php

namespace App\Enum;

enum NoteVisibility :string  
{
  case PRIVATE="private";
  case PUBLIC= "public";
  case SHARED= "shared";
}
