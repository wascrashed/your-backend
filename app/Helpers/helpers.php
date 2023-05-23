<?php

//namespace App\Helpers;
if (!function_exists('getFileType')) {

    function getFileType($fileExtension)
    {
        $fileTypes = [
            'jpg' => 'image',
            'jpeg' => 'image',
            'png' => 'image',
            'webp' => 'image',
            'svg' => 'image',
            'mp4' => 'video',
            'avi' => 'video',
            'pdf' => 'file',
            'docx' => 'file'
        ];

        if (!array_key_exists($fileExtension, $fileTypes)) {
            return null;
        }

        return $fileTypes[$fileExtension];
    }
}
