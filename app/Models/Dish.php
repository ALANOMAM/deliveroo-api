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
        'ingredients',
    ];

    protected $attributes = [
        'visible' => true,
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function orders()
    {
        // return $this->belongsToMany(Order::class, 'dish_order');
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }
}
