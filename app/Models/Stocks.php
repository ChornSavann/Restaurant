<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;
    protected $fillable = ['food_id', 'quantity', 'unit', 'description', 'image'];

    public function food()
    {
        return $this->belongsTo(Foods::class);

    }
}
