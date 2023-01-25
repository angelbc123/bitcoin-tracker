<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BitcoinChartResource;
use App\Models\BitcoinState;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BitcoinStateController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $bitcoinStateQuery = (new BitcoinState())
            ->select(['last_price', 'valid_until'])
            ->whereSixMonthsBack()
            ->get();

        return BitcoinChartResource::collection($bitcoinStateQuery);
    }
}
