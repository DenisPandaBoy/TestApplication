<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use App\Services\OrderService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function show($id): JsonResponse
    {
        $order = $this->orderRepository->getOrderById($id);

        $resource = OrderResource::make($order);

        return $this->responseJson(data: $resource);
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $order = $this->orderService->CreateOrder(DateTime::createFromFormat('Y-m-d',$validated['due_date']));

        return $this->responseJson(data: $order, message: 'Order created successfully.');
    }
}
