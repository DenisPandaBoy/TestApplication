<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemService
{
    public function createOrderItem(int $order_id, array $data): OrderItem
    {
        $order = Order::findOrFail($order_id);

        return $order->orderItems()->create($data);
    }

    public function updateOrderItem(OrderItem $orderItem, array $data): OrderItem
    {
        $orderItem->update($data);
        return $orderItem;
    }

    public function destroy(OrderItem $orderItem): OrderItem
    {
        $orderItem->delete();
        return $orderItem;
    }
}
