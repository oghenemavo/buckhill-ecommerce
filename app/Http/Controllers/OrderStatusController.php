<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStatusRequest;
use App\Repositories\OrderStatusRepository;

class OrderStatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\OrderStatusRepository  $orderStatusRepository
     * @return void
     */
    public function __construct(protected OrderStatusRepository $orderStatusRepository)
    {
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orderStatuses = $this->orderStatusRepository->fetchOrderStatuses();

        return response()->json([
            'status' => true,
            'message' => 'Order Statuses Retrieved Successfully',
            'data' => $orderStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\OrderStatusRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderStatusRequest $request)
    {
        $orderStatus = $this->orderStatusRepository->add($request->validated());
        if ($orderStatus) {
            return response()->json([
                'status' => true,
                'message' => 'Order Status created successfully',
                'data' => $orderStatus,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Order Status',
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
        $orderStatus = $this->orderStatusRepository->fetchOrderStatus($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Order Status Retrieved Successfully',
            'data' => $orderStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\OrderStatusRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OrderStatusRequest $request, $uuid)
    {
        $orderStatus = $this->orderStatusRepository->updateOrderStatus($uuid, $request->validated());
        if ($orderStatus) {
            return response()->json([
                'status' => true,
                'message' => 'Order Status updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Order Status ',
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
        $this->orderStatusRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Order Status  deleted successfully',
        ]);
    }
}
