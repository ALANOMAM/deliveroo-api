<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_name',
        'restaurant_id',
        'visible',
        'dish_price',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
