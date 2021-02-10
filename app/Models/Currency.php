<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        $exchangeRate = file_get_contents(env('BANK_EXCHANGE_URL'));
        $exchange = json_decode($exchangeRate, true);
        return array_column($exchange, 'cc');
    }
}
