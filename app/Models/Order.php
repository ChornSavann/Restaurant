<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    // In Order.php
    protected $fillable = [
        'customer_id', 'total_amount', 'customer_pay', 'change_amount',
        'payment_method', 'card_number', 'expiry', 'cvc', 'status'
    ];

    public function orderItems() {
        return $this->hasMany(OrderItem::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

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
