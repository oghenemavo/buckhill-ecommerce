<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Repositories\FileRepository;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\FileRepository  $fileRepository
     * @return void
     */
    public function __construct(protected FileRepository $fileRepository, protected FileUploadService $fileService)
    {
        $this->fileRepository = $fileRepository;
        $this->fileService = $fileService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileRequest $request)
    {
        $fileObject = $this->fileService->store($request->validated()['image'], '', false);

        if (isset($fileObject)) {
            $file = $this->fileRepository->add($fileObject);
            if ($file) {
                return response()->json([
                    'status' => true,
                    'message' => 'File stored successfully',
                    'data' => $file,
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to store File',
        ]);
    }

    /**
     * download file
     *
     * @param  string  $uuid
     * @return \Illuminate\Auth\Access\Response
     */
    public function download($uuid)
    {
        $fileObject = $this->fileRepository->fetchFile($uuid);
        $filename = explode('.', $fileObject->name)[0];

        return response()->download(public_path('storage/' . $fileObject->path), $filename);
  
    }
}
