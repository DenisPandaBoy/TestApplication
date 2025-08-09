<?php

namespace App\Services;

use App\Models\Order;
use DateTime;

class OrderService
{
    public function CreateOrder(DateTime $due_date): Order
    {
        $collection = Order::query()->whereLike('order_number', $due_date->format('Y').'%')->get();

        $max = 0;
        foreach ($collection as $order) {
            $newValue =intval(substr($order['order_number'],4));
            if( $newValue> $max) $max = $newValue;
        }
        $nextId= $max+1;

        $order_number = $due_date->format('Y'). sprintf('%05d', $nextId);

        $data = [
            'order_number' => $order_number,
            'due_date' => $due_date,
            'payment_date' => date('Y-m-d H:i:s')
        ];
        $order = Order::create($data);
        $order->save();

        return $order;
    }
}
