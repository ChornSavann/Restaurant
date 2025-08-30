<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class orderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'food_id',
        'food_name',
        'quantity',
        'unit_price',
        'total_price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function food()
    {
        return $this->belongsTo(Foods::class);
    }

    public function stock()
    {
        return $this->hasOne(Stocks::class);
    }

}
