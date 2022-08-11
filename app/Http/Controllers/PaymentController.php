<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\PaymentRequest;
use App\Repositories\PaymentRepository;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\PaymentRepository  $paymentRepository
     * @return void
     */
    public function __construct(protected PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PaginationRequest $request)
    {
        $payments = $this->paymentRepository->fetchPayments($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Payments Retrieved Successfully',
            'data' => $payments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PaymentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PaymentRequest $request)
    {
        $payment = $this->paymentRepository->add($request->validated());
        if ($payment) {
            return response()->json([
                'status' => true,
                'message' => 'Payment created successfully',
                'data' => $payment,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Payment',
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
        $payment = $this->paymentRepository->fetchPayment($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Payment Retrieved Successfully',
            'data' => $payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PaymentRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PaymentRequest $request, $uuid)
    {
        $payment = $this->paymentRepository->updatePayment($uuid, $request->validated());
        if ($payment) {
            return response()->json([
                'status' => true,
                'message' => 'Payment updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update Payment',
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
        $this->paymentRepository->delete($uuid);

        return response()->json([
            'status' => true,
            'message' => 'Payment deleted successfully',
        ]);
    }
}
