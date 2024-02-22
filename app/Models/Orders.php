<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['total', 'ordered_at', 'items_titles'];
    protected $hidden = ['order_items', 'created_at', 'updated_at'];

    public function order_items()
    {
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }

    public function getOrderedAtAttribute()
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    public function getTotalAttribute()
    {
        return $this->order_items->sum('total');
    }

    public function getItemsTitlesAttribute()
    {
        $arr = [];

        foreach($this->order_items as $order_item) {
            $arr[] = $order_item->item_title;
        }

        return implode(', ', $arr);
    }
}
