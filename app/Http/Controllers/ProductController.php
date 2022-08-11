<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\ProductRepository  $productRepository
     * @return void
     */
    public function __construct(protected ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        $products = $this->productRepository->fetchProducts($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Products Retrieved Successfully',
            'data' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->add($request->validated());
        if ($product) {
            return response()->json([
                'status' => true,
                'message' => 'Product created successfully',
                'data' => $product,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Product',
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
        $product = $this->productRepository->fetchProduct($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Product Retrieved Successfully',
            'data' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductRequest $request, $uuid)
    {
        $product = $this->productRepository->updateProduct($uuid, $request->validated());
        if ($product) {
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Product',
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
        $this->productRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully',
        ]);
    }
}
