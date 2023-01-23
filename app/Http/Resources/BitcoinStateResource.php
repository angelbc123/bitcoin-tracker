<?php

namespace App\Http\Resources;

use App\Models\BitcoinState;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin BitcoinState
 */
class BitcoinStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'y' => (float) $this->last_price,
            'x' => $this->valid_until->toDateString(),
        ];
    }
}
