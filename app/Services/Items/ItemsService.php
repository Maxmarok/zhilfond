<?php

namespace App\Services\Items;

use App\Models\Items;
use Illuminate\Http\JsonResponse;

class ItemsService implements ItemsInterface 
{

    public function __construct()
    {
        
    }

    /**
     * Get items list for users
     */
    public function getItems(): JsonResponse
    {
        $items = Items::paginate(10);

        return response()->json([
            'items' => $items,
        ]);
    }
}