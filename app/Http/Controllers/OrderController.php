<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends APIController
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository
    ){}

    public function index(): JsonResponse
    {
        $orders = $this->orderRepository->getOrders();

        $resource = OrderResource::collection($orders);

        return $this->responseJson(data: $resource);
    }
}
