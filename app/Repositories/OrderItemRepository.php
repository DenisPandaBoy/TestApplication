<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function getOrderItems(int $orderId): Collection
    {
        $order = Order::findOrFail($orderId);
        return $order->orderItems;
    }

    public function getOrderItemById(int $id): OrderItem
    {
        return OrderItem::query()->findOrFail($id);
    }
}
