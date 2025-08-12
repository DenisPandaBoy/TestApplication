<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function getOrders(): Collection;

    public function getOrderById($id): Order;

    public function getOrdersByCategoryId(int $categoryId): Collection;
}
