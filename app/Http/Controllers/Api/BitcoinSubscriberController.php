<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BitcoinSubscriberRequest;
use App\Models\BitcoinSubscriber;
use Illuminate\Http\Request;

class BitcoinSubscriberController extends Controller
{
    public function store(BitcoinSubscriberRequest $request)
    {
        BitcoinSubscriber::updateOrCreate(
            ['email' => $request->validated('email')],
            $request->validated()
        );

        return response()
            ->json(['success' => true]);
    }
}
