<?php

namespace App\Repositories;

use App\Interfaces\IFileRepository;
use App\Models\File;

class FileRepository implements IFileRepository
{
    public function __construct(protected File $file)
    {
        $this->file = $file;
    }

    public function add(object|array $attributes)
    {
        return $this->file->create([
            'path' => data_get($attributes, 'path'),
            'name' => data_get($attributes, 'filename'),
            'type' => data_get($attributes, 'mime'),
            'size' => data_get($attributes, 'size'),
        ]);
    }

    public function fetchFile($uuid)
    {
        return $this->file->query()->where('uuid', $uuid)->firstOrFail();
    }
}
