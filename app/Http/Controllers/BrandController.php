<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Repositories\BrandRepository;

class BrandController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\BrandRepository  $brandRepository
     * @return void
     */
    public function __construct(protected BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $brands = $this->brandRepository->fetchBrands();

        return response()->json([
            'status' => true,
            'message' => 'Brands Retrieved Successfully',
            'data' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BrandRequest $request)
    {
        $brand = $this->brandRepository->add($request->validated());
        if ($brand) {
            return response()->json([
                'status' => true,
                'message' => 'Brand created successfully',
                'data' => $brand,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Brand',
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
        $brand = $this->brandRepository->fetchBrand($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Brand Retrieved Successfully',
            'data' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BrandRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BrandRequest $request, $uuid)
    {
        $brand = $this->brandRepository->updateBrand($uuid, $request->validated());
        if ($brand) {
            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Brand',
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
        $this->brandRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully',
        ]);
    }
}
