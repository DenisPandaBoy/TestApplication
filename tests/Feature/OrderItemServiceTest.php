<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use tests\TestCase;

class OrderItemServiceTest extends TestCase
{
    use RefreshDatabase;
    public function test_createOrderItem_function(): void
    {
        $category = Category::factory()->create();
        $order = Order::factory()->create(['category_id' => $category]);
        $inputData = OrderItem::factory()->make()->toArray();

        $orderItemService = new OrderItemService();
        $result = $orderItemService->createOrderItem($order->id,$inputData);

        $this->assertDatabaseHas('order_items',$result->toArray());
    }

    public function test_updateOrderItem_function(): void{
        $category = Category::factory()->create();
        $order = Order::factory()->create(['category_id' => $category]);
        $orderItem = OrderItem::factory()->create(['order_id' => $order]);

        $inputData = OrderItem::factory()->make()->toArray();
        $orderItemService = new OrderItemService();
        $orderItemService->updateOrderItem($orderItem,$inputData);

        $this->assertDatabaseHas('order_items',array_merge($inputData,['id' => $orderItem->id]));
    }

    public function test_deleteOrderItem_function(): void{
        $category = Category::factory()->create();
        $order = Order::factory()->create(['category_id' => $category]);
        $orderItem = OrderItem::factory()->create(['order_id' => $order]);

        $orderItemService = new OrderItemService();
        $orderItemService->destroy($orderItem);

        $this->assertDatabaseMissing('order_items', $orderItem->toArray());
    }
}
