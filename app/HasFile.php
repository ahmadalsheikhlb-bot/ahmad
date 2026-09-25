<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasFile
{
   public function Storefiles(UploadedFile $file ,string $Foldername)
   {
    return $file->store($Foldername,'public');
   }
   public function Deletefiles(string $path)
   {
    if(empty($path)) 
        {
            return false;
        }
    if(Storage::disk('public')->exists($path))
        {
        Storage::disk('public')->delete($path);
        }
        else{
            return false;
        }
   }

   public function ReplaceFiles(string $oldpath, UploadedFile $newfile,string $Foldername)
   {
    Storage::disk('public')->delete($oldpath);
    return $newfile->store($Foldername,'public');
   }
}
