<?php

namespace App\Observers;

use App\Models\MediaFile;

class MediaFileObserver
{
    public function creating(MediaFile $mediaFile)
    {
        $mediaFile->file_type =  !$mediaFile->is_link ?  getFileType(request()->file('file')->extension()) : $mediaFile->file_type;
    }
}
