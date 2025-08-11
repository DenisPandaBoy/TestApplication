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
        return  OrderItem::where('order_id',$orderId)->get();
    }

    public function getOrderItemById(int $id): OrderItem
    {
        return OrderItem::query()->findOrFail($id);
    }
}
