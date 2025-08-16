<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    // In Order.php
    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id');
    }

    protected $fillable = [
        'order_number', 'customer_name', 'phone', 'address',
        'total_amount', 'customer_pay', 'change_amount',
        'payment_method', 'card_number', 'expiry', 'cvc', 'image'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
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
