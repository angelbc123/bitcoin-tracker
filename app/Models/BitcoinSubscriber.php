<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
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
    use Notifiable;

    protected $guarded = [
        'id'
    ];
}
