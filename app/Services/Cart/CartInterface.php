<?php

namespace App\Services\Cart;

use Illuminate\Http\JsonResponse;

interface CartInterface 
{
    /**
     * Get items for user cart
     */
    public function getCart(array $data): JsonResponse;
}