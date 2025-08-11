<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

class OrderItemRepository implements OrderItemRepositoryInterface
{
    public function getOrderItems(): Collection
    {
        return OrderItem::query()->get();
    }

    public function getOrderItemById(int $id): OrderItem
    {
        return OrderItem::query()->findOrFail($id);
    }
}
