<?php

namespace App\Repositories;

use App\Interfaces\IFileRepository;
use App\Models\File;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class FileRepository implements IFileRepository
{
    public function __construct(protected File $file)
    {
        $this->file = $file;
    }

    public function add(array $attributes)
    {
        $fileInfo = $this->store($attributes['image'], 'files', false);

        return $this->file->create([
            'path' => data_get($fileInfo, 'path'),
            'name' => data_get($fileInfo, 'original_name'),
            'type' => data_get($fileInfo, 'mime'),
            'size' => data_get($fileInfo, 'size'),
        ]);
    }

    public function fetchFile($uuid)
    {
        return $this->file->query()->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Store media and return path
     *
     * @param UploadedFile|UploadedFile[]|null $uploadedFile
     * @param $store_path
     * @param bool $get_path_only
     * @return array|string|null
     */
    protected function store($uploadedFile, $store_path = '', $get_path_only = true)
    {
        if ($uploadedFile->isValid()) {
            $path          = $uploadedFile->store($store_path, 'public');
            $file = (object) [
                'path' => $path,
                'original_name' => $uploadedFile->hashName(),
                'mime' => $uploadedFile->getClientMimeType(),
                'size' => $uploadedFile->getSize(),
            ];

            if ($get_path_only) return $path;

            return $file;

        } else {
            throw new UploadException("Uploaded file is not valid.");
        }
    }

}
