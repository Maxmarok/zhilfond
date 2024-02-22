<?php

namespace App\Services\Cart;

use App\Models\Items;
use Illuminate\Http\JsonResponse;

class CartService implements CartInterface 
{

    public function __construct()
    {
        
    }

    /**
    * Get items from cart
    */
    public function getCart(array $data): JsonResponse
    {
        $ids = $data['ids'];

        $items = Items::whereIn('id', $ids)->get();

        return response()->json([
            'items' => $items,
        ]);
    }
}