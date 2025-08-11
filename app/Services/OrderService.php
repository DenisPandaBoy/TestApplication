<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use DateTime;

class OrderService
{
    public function createOrder(array $data): Order
    {
        $order_number = Order::query()->Max('order_number') + 1;

        $data = [
            'order_number' => $order_number,
            'due_date' => $data['due_date'],
            'payment_date' => $data['payment_date'],
        ];
        $order = Order::create($data);
        $order->save();

        return $order;
    }

    public function updateOrder(Order $order, array $data): Order
    {
        $order->update($data);
        return $order;
    }

    public function deleteOrder(Order $order): Order
    {
        $order->delete();
        return $order;
    }
}
