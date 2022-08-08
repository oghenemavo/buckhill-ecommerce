<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Repositories\FileRepository;

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

    
}
