<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_surname',
        'customer_email',
        'customer_phone',
        'customer_address',
        'total_price',
        'message',
    ];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class)
            ->withPivot('quantity', 'price');
    }
}
