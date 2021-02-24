<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Color
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Color newModelQuery()
 * @method static Builder|Color newQuery()
 * @method static Builder|Color query()
 * @method static Builder|Color whereCreatedAt($value)
 * @method static Builder|Color whereId($value)
 * @method static Builder|Color whereName($value)
 * @method static Builder|Color whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
