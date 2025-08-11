<?php

namespace App\Services;

use App\Models\Order;
use DateTime;

class OrderService
{
    public function createOrder(DateTime $due_date): Order
    {
        $order_number = Order::query()->Max('order_number') + 1;

        $data = [
            'order_number' => $order_number,
            'due_date' => $due_date,
            'payment_date' => date('Y-m-d H:i:s')
        ];
        $order = Order::create($data);
        $order->save();

        return $order;
    }

    public function updateOrder(Order $order, array $data): Order
    {
        $order->update($data);
        $order->updated_at = now();
        $order->save();
        return $order;
    }

    public function deleteOrder(Order $order): Order
    {
        $order->delete();
        return $order;
    }
}
