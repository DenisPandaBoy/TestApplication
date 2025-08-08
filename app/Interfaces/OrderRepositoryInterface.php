<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{
    public function getOrders(): Collection;
}
