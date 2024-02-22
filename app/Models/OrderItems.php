<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['total', 'item_title'];
    protected $hidden = ['item'];

    public function item()
    {
        return $this->belongsTo(Items::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Items::class, 'id', 'item_id');
    }

    public function getItemTitleAttribute()
    {
        return $this->item->title;
    }

    public function getTotalAttribute()
    {
        return $this->item->price * $this->quantity;
    }
}
