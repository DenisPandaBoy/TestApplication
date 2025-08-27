<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use App\Services\OrderService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class OrderController extends APIController
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
        private readonly OrderService $orderService
    ){}

    public function index(): JsonResponse
    {
        $orders = $this->orderRepository->getOrders();

        $resource = OrderResource::collection($orders);

        return $this->responseJson(data: $resource);
    }

    public function show(int $id): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($id);

        $resource = OrderResource::make($order);

        return $this->responseJson(data: $resource);
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->all());

        return $this->responseJson(data: $order, message: 'Order created successfully.');
    }

    public function update(UpdateOrderRequest $request, int $id): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($id);

        $updatedOrder = $this->orderService->updateOrder($order, $request->all());

        return $this->responseJson(data: $updatedOrder, message: 'Order updated successfully.');
    }

    public function destroy(int $id): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($id);

        $orderNumber = $this->orderService->deleteOrder($order);

        return $this->responseJson(message: "Order $orderNumber deleted successfully.");
    }

    public function getStatuses(int $id): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($id);
        
        return $this->responseJson(data: $order->statuses()->get());
    }
}
