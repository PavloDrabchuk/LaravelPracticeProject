<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $code
 * @property string $sign
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Price[] $prices
 * @property-read int|null $prices_count
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @method static Builder|Currency whereCode($value)
 * @method static Builder|Currency whereCreatedAt($value)
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereSign($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Currency extends Model
{
    use HasFactory;

    protected $fillable=[
        'code',
        'sign'
    ];

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function getAllPossibleCurrencyCode(){
        Log::info("---bank:  ".env('BANK_EXCHANGE_URL'));
        $exchangeRate = file_get_contents(env('BANK_EXCHANGE_URL'));
        $exchange = json_decode($exchangeRate, true);
        return array_column($exchange, 'cc');
    }
}
