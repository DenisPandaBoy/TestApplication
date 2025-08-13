<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function getOrders(): Collection
    {
        return Order::visibleForUser()->get();
    }

    public function getOrderById(int $id): Order
    {
        return Order::visibleForUser()->findOrFail($id);
    }

    public function getOrdersByCategoryId(int $categoryId): Collection
    {
        return Order::visibleForUser()->where('category_id', $categoryId)->get();
    }
}
