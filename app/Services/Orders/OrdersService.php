<?php

namespace App\Services\Orders;

use App\Models\OrderItems;
use App\Models\Orders;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrdersService implements OrdersInterface
{
    public function __construct()
    {
        
    }

    /**
     * Get orders list for admin
     */
    public function getOrders(): JsonResponse
    {
        $total = Orders::get()->sum('total');
        $orders = Orders::orderBy('id', 'desc')->withoutTrashed()->paginate(10);


        return response()->json([
            'success' => true,
            'orders' => $orders,
            'total' => $total,
        ]); 
    }

    /**
    * Make order from user
    */
    public function createOrder(array $data): JsonResponse
    {
        $order = Orders::create();

        $arr = [];
        $items = $data['items'];
       
        foreach($items as $item) {
            $arr[] = [
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'quantity' => $item['count'],
            ];
        }

        OrderItems::insert($arr);

        return response()->json([
            'success' => true,
            'order' => $order,
        ]);
    }

    /** 
     * Delete order by admin
     */
    public function deleteOrder(string $id): JsonResponse
    {
        Log::debug($id);
        $delete = Orders::where('id', $id)->delete();

        if($delete) {
            return response()->json([
                'success' => true,
            ]); 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось найти или удалить заказ'
            ], 500); 
        }
    }
}
