<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $table = 'tours';

    protected $fillable = [
        'name',
        'category_id',
        'quantity',
        'article',
        'color_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function cartItem()
    {
        return $this->hasOne(CartItem::class);
    }
}
