<?php

namespace App\Services;

use App\Models\MediaFile;
use Illuminate\Support\Facades\Storage;

class MediaFileService
{
    public static function create(array $data)
    {
        $file = Storage::disk('public')->put('mediaFiles', $data['file']);
        $media = MediaFile::create([
            'file' => $file
        ] + $data);

        return $media;
    }
}
