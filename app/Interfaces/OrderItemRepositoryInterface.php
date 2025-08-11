<?php

namespace App\Interfaces;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Collection;

interface OrderItemRepositoryInterface
{
    public function getOrderItems(): Collection;

    public function getOrderItemById(int $id): OrderItem;
}
