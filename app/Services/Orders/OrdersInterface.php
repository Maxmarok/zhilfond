<?php

namespace App\Services\Orders;

use Illuminate\Http\JsonResponse;

interface OrdersInterface
{
    /**
     * Get orders list for admin
     */
    public function getOrders(): JsonResponse;

    /**
    * Make order from user
    */
    public function createOrder(array $data): JsonResponse;

    /** 
     * Delete order by admin
     */
    public function deleteOrder(string $id): JsonResponse;
}
