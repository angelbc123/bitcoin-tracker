<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property float $mid
 * @property float $bid
 * @property float $ask
 * @property float $last_price
 * @property float $low
 * @property float $high
 * @property float $volume
 * @property Carbon $valid_until
 *
 * @method whereSixMonthsBack()
 */
class BitcoinState extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'valid_until' => 'datetime'
    ];

    public function scopeWhereSixMonthsBack(Builder $builder): Builder
    {
        return $builder->whereDate('valid_until', '>=', Carbon::today()->subMonths(6))
            ->whereDate('valid_until', '<=', Carbon::today());
    }
}
