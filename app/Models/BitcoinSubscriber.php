<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder;

/**
 * @mixin Builder
 *
 * @property string $email
 * @property float $amount_threshold
 */
class BitcoinSubscriber extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
