<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_name',
        'vat',
        'address',
        'phone',
        'description',
        'image',
    ];

    // Definizione della relazione con l'utente
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
