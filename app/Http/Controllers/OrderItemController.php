<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Order;
use App\Services\OrderItemService;
use Illuminate\Http\JsonResponse;

class OrderItemController extends APIController
{
    public function __construct(
        private readonly OrderItemRepositoryInterface $orderItemRepository,
        private readonly OrderItemService             $orderItemService
    )
    {
    }

    public function index(int $orderId): JsonResponse
    {
        $orderItems = $this->orderItemRepository->getOrderItems($orderId);
        $resource = OrderItemResource::collection($orderItems);

        return $this->responseJson(data: $resource);
    }

    public function store(CreateOrderItemRequest $request, int $orderId): JsonResponse
    {
        $orderItem = $this->orderItemService->createOrderItem($orderId,$request->all());

        $resource = OrderItemResource::make($orderItem);

        return $this->responseJson(data: $resource, message: "Order Item created successfully");
    }

    public function update(UpdateOrderItemRequest $request, int $id): JsonResponse
    {
        $orderItem = $this->orderItemRepository->getOrderItemById($id);

        $updatedItem = $this->orderItemService->updateOrderItem($orderItem, $request->all());

        $resource = OrderItemResource::make($updatedItem);
        $updatedItemName = $resource->name;

        return $this->responseJson(data: $resource, message: "Order Item $updatedItemName updated successfully");
    }

    public function destroy(int $id): JsonResponse
    {
        $orderItem = $this->orderItemRepository->getOrderItemById($id);

        $itemName = $this->orderItemService->destroy($orderItem)->name;

        return $this->responseJson(data: $orderItem, message: "Order Item $itemName deleted successfully");
    }
}
