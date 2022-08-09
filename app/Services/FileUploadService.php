<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class FileUploadService
{
    /**
     * Store media and return path
     *
     * @param  UploadedFile|UploadedFile[]|null  $uploadedFile
     * @param $store_path
     * @param  bool  $get_path_only
     * @return array|string|null
     */
    public function store($uploadedFile, $store_path = '', $get_path_only = true)
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