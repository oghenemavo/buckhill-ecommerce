<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\OrderRepository;
use PDF;

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
        $orders = $this->orderRepository->fetchOrders($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Orders Retrieved Successfully',
            'data' => $orders,
        ]);
    }

    public function download($uuid)
    {
        $order = $this->orderRepository->fetchOrder($uuid);

        $products = json_decode($order->products);
        
        $payment = Payment::query()->find($order->payment_id);
        $paymentType = $payment->type;
        $paymentDetails = array_values(json_decode($payment->details, true));

        $address = json_decode($order->address);
        $address = json_decode($order->address);

        $user = User::query()->find($order->user_id);
        // var_dump($payment);
        // var_dump(getProduct($products->{'1'}->product)->title);
        // var_dump($paymentDetails);
        // exit;
        

        view()->share('order',$order);
        view()->share('products',$products);
        view()->share('payment',$payment);
        view()->share('paymentType',$paymentType);
        view()->share('paymentDetails',$paymentDetails);
        view()->share('address',$address);
        view()->share('address',$address);
        view()->share('user',$user);
        $pdf = PDF::loadView('pdf/order');
        
        return $pdf->download('disney.pdf');
    }

    public function shipmentLocator(PaginationRequest $request)
    {
        $orders = $this->orderRepository->fetchOrdersByShipment($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Orders Retrieved Successfully',
            'data' => $orders,
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
