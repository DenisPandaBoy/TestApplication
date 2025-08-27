<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderId = Order::first()->id;
        DB::table('orders_statuses')->insert([
            [
                'status' => OrderStatus::NEW->value,
                'order_id' => $orderId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => OrderStatus::PROCESSING->value,
                'order_id' => $orderId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => OrderStatus::COMPLETED->value,
                'order_id' => $orderId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
