<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BitcoinStateResource;
use App\Models\BitcoinState;
use Illuminate\Http\Request;

class BitcoinStateController extends Controller
{

    public function index()
    {
        $bitcoinStateQuery = BitcoinState::query()
            ->get();

        return BitcoinStateResource::collection($bitcoinStateQuery);
    }
}
