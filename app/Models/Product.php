<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property array|null $name
 * @property int $category_id
 * @property int $quantity
 * @property string $article
 * @property int $color_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CartItem|null $cartItem
 * @property-read Category $category
 * @property-read Color $color
 * @property-read array $translations
 * @property-read Collection|\App\Models\Price[] $prices
 * @property-read int|null $prices_count
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereArticle($value)
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereColorId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereQuantity($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @mixin Eloquent
 */
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
