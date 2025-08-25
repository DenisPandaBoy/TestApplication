<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Services\OrderService;
use tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function test_createOrder_function(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $inputData = Order::factory()->make(['category_id'=> $category->id])->toArray();

        $this->actingAs($user);

        $nextOrderNumber = Order::query()->Max('order_number') + 1;

        $orderService = new OrderService();
        $orderService->createOrder($inputData);

        $this->assertDataBaseHas('orders', array_merge($inputData , ['order_number' => $nextOrderNumber]));
    }

    public function test_updateOrder_function(): void
    {
        $category = Category::factory()->create();
        $category2 = Category::factory()->create();
        $order = Order::factory()->create(['category_id' => $category->id]);
        $inputData = Order::factory()->make(['category_id' => $category2->id])->toArray();

        $orderService = new OrderService();
        $orderService->updateOrder($order,$inputData);

        $this->assertDatabaseHas('orders', array_merge($inputData, ['id'=> $order->id]));
    }

    public function test_deleteOrder_function(): void
    {
        $category = Category::factory()->create();
        $order = Order::factory()->create(['category_id' => $category->id]);

        $orderService = new OrderService();
        $orderService->deleteOrder($order);

        $this->assertDatabaseMissing('orders', $order->toArray());
    }
}
