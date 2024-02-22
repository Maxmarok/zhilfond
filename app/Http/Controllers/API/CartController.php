<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\GetCartRequest;
use App\Services\Cart\CartInterface;
use App\Services\Orders\OrdersInterface;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
    * Get items from cart
    */
    public function getCart(CartInterface $service, GetCartRequest $request): JsonResponse
    {
        return $service->getCart($request->validated());
    }

    /**
    * Make order from user
    */
    public function createOrder(OrdersInterface $service, CreateOrderRequest $request): JsonResponse
    {
        return $service->createOrder($request->validated());
    }
}
