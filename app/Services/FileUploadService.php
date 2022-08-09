<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class FileUploadService
{
    /**
     * Store media and return path
     *
     * @param  UploadedFile  $uploadedFile
     * @param  string $store_path
     * @param  bool  $get_path_only
     * @return object|string
     */
    public function store(UploadedFile $uploadedFile, $store_path = '', $get_path_only = true)
    {
        if ($uploadedFile->isValid()) {
            $path = $uploadedFile->store($store_path, 'public');
            $file = (object) [
                'path' => $path,
                'filename' => $uploadedFile->getClientOriginalName(),
                'hash_filename' => $uploadedFile->hashName(),
                'mime' => $uploadedFile->getClientMimeType(),
                'size' => $uploadedFile->getSize(),
            ];

            if ($get_path_only) {
                return $path;
            }

            return $file;
        } else {
            throw new UploadException('Uploaded file is not valid.');
        }
    }
}
