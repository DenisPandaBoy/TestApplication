<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function getOrders(): Collection
    {
        return Order::query()->get();
    }

    public function getOrderById($id): Order
    {
        return Order::query()->findOrFail($id);
    }

    public function getOrdersByCategoryId(int $categoryId): Collection
    {
        return Order::where('category_id', $categoryId)->get();
    }
}
