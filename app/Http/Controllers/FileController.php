<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\FileRepository  $fileRepository
     * @return void
     */
    public function __construct(protected FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileRequest $request)
    {
        $file = $this->fileRepository->add($request->validated());
        if ($file) {
            return response()->json([
                'status' => true,
                'message' => 'File created successfully',
                'data' => $file,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to file Category',
        ]);
    }

    /**
     * download file
     * 
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function download(Request $request, $uuid)
    {
        $fileObject = $this->fileRepository->fetchFile($uuid);
        return Storage::download($fileObject->path);
    }

    
}
