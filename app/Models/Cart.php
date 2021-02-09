<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

     /*protected $casts = [
        'products' => 'array'
    ];*/

    protected $fillable = [
        //'id',
        'user_id',
        //'products',
        ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
