<?php

namespace App\Services\Items;

use Illuminate\Http\JsonResponse;

interface ItemsInterface 
{
    /**
     * Get items list for users
     */
    public function getItems(): JsonResponse;
}