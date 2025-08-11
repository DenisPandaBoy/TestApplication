<?php

namespace App\Services;

use App\Models\OrderItem;

class OrderItemService
{
    public function createOrderItem(array $data): OrderItem
    {
        return OrderItem::create($data);
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
