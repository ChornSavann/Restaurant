<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers'; // បញ្ជាក់ table តាម DB

    protected $fillable = [
        'name', 'phone', 'address'
    ];

    // Relation to reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id');
    }

    // Relation to orders (optional, useful for reports)
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
