<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(protected CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->categoryRepository->fetchCategories();

        return response()->json([
            'status' => true,
            'message' => 'Categories Retrieved Successfully',
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->add($request->validated());
        if ($category) {
            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'data' => $category,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Category',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($uuid)
    {
        $category = $this->categoryRepository->fetchCategory($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Category Retrieved Successfully',
            'data' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryRequest $request, $uuid)
    {
        $category = $this->categoryRepository->updateCategory($uuid, $request->validated());
        if ($category) {
            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Category',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($uuid)
    {
        $this->categoryRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully',
        ]);
    }
}
