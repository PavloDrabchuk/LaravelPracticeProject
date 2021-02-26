<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Price
 *
 * @property int $id
 * @property float $value
 * @property int $currency_id
 * @property int $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Currency $currency
 * @property-read Product $product
 * @method static Builder|Price newModelQuery()
 * @method static Builder|Price newQuery()
 * @method static Builder|Price query()
 * @method static Builder|Price whereCreatedAt($value)
 * @method static Builder|Price whereCurrencyId($value)
 * @method static Builder|Price whereId($value)
 * @method static Builder|Price whereProductId($value)
 * @method static Builder|Price whereUpdatedAt($value)
 * @method static Builder|Price whereValue($value)
 * @mixin Eloquent
 */
class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'currency_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

}
