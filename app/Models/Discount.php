<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'food_id',
        'discount_percent',
        'start_date',
        'end_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    public function stock()
    {
        // Make sure Stocks table has a food_id column
        return $this->belongsTo(Stocks::class, 'food_id', 'food_id');
    }

    // Relation to Food
    public function food()
    {
        return $this->belongsTo(Foods::class, 'food_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
