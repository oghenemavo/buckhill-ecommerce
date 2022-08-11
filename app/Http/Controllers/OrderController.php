<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\OrderRepository  $order
     * @return void
     */
    public function __construct(protected OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        $order = $this->orderRepository->fetchOrders($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Orders Retrieved Successfully',
            'data' => $order,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request)
    {
        $order = $this->orderRepository->add($request->validated());
        if ($order) {
            return response()->json([
                'status' => true,
                'message' => 'Order created successfully',
                'data' => $order,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Order',
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
        $order = $this->orderRepository->fetchOrder($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Order Status Retrieved Successfully',
            'data' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrderRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderRequest $request, $uuid)
    {
        $order = $this->orderRepository->updateOrder($uuid, $request->validated());
        if ($order) {
            return response()->json([
                'status' => true,
                'message' => 'Order updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Order',
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
        $this->orderRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Order deleted successfully',
        ]);
    }
}
