<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    protected $table = 'food';
    protected $fillable = ['title', 'price','category_id', 'desc', 'image'];

    public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stocks()
    {
        return $this->hasOne(Stocks::class, 'food_id', 'id'); // assuming 1 stock per food
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'food_id');
    }



}
