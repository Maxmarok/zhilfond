<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Items\ItemsInterface;
use Illuminate\Http\JsonResponse;

class ItemsController extends Controller
{
    /**
     * Get items list for users
     */
    public function getItems(ItemsInterface $service): JsonResponse
    {
        return $service->getItems();
    }
}
