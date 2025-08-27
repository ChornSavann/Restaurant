<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $primaryKey = 'delivery_id';

    protected $fillable = [
        'order_id',
        'customer_id',
        'delivery_address',
        'delivery_status',
        'delivery_date',
        'delivery_time',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    
}
