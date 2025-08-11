<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderItemRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderItemController extends APIController
{
    public function __construct(
        private readonly OrderItemRepositoryInterface $orderItemRepository
    ){}

    public function index(): JsonResponse
    {
        $orderItems = $this->orderItemRepository->getOrderItems();
        $resource = OrderItemResource::collection($orderItems);

        return $this->responseJson(data: $resource);
    }
}
