<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'currency',
        'product_id',
    ];

    public function price()
    {
        return $this->morphTo();
    }
}
