<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;
    protected $table = 'food'; // if your table is named 'food'
    // app/Models/Food.php

    public function categoryid()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
