<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Orders\OrdersInterface;
use Illuminate\Http\JsonResponse;

class OrdersController extends Controller
{
    /**
     * Get orders list for admin
     */
    public function getOrders(OrdersInterface $service): JsonResponse
    {
        return $service->getOrders();
    }

    /** 
     * Delete order by admin
     */
    public function deleteOrder(OrdersInterface $service, string $id): JsonResponse
    {
        return $service->deleteOrder($id);
    }
}
