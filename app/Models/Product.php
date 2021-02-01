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
        'price_id',
    ];
}
