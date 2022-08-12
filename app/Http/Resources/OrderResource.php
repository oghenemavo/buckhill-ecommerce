<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'user' => UserResource::make($this->whenLoaded('user')),
            'order_status' => OrderStatusResource::make($this->whenLoaded('order_status')),
            'payment' => PaymentResource::make($this->whenLoaded('payment')),
            'products' => $this->products,
            'amount' => $this->amount,
            'delivery_fee' => $this->delivery_fee,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'shipped_at' => $this->shipped_at,
        ];
    }
}
