<?php

namespace App\Http\Resources;

use App\Models\BitcoinState;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin BitcoinState
 */
class BitcoinChartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'y' => (float) $this->last_price,
            'x' => $this->valid_until->toDateString(),
        ];
    }
}
