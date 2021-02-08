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
// signs - https://index.minfin.com.ua/ua/reference/currency/sign/

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
