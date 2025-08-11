<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // In Order.php
    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }



    protected $fillable = [
        'food_id',
        'food_name',
        'quantity',
        'image',
        'notes',
        'total_price',
        'customer_name',
        'phone',
        'address',
        'order_number',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                do {
                    $randomNumber = mt_rand(1000, 9999); // generates 4-digit number
                    $orderNumber = 'OR' . $randomNumber;
                } while (self::where('order_number', $orderNumber)->exists());

                $order->order_number = $orderNumber;
            }
        });
    }

    public function statusBadgeClass()
    {
        return match ($this->status) {
            'pending' => 'warning',
            'shipped' => 'success',
            'delivered' => 'danger',
            'processing' => 'info',
            default => 'secondary',
        };
    }
}
