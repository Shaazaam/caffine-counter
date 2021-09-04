<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Auth,
    DB
};

use App\Models\Drink;
use App\Http\Requests\CounterRequest;

class CounterController extends Controller
{
    public function index(Request $request)
    {
        return view('counter', [
            'drinks'      => Drink::getAll()->toJson(),
            'safeLimit'   => Drink::SAFE_LIMIT,
            'lethalLimit' => Drink::LETHAL_LIMIT,
        ]);
    }

    public function calculateCaffeineAmount(CounterRequest $request)
    {
        $input = $request->input();

        // Would love to use BCMath, but of course that can't "just work" out of the box
        // php -m says it's enabled...
        $total = array_reduce($input, function ($accumulator, $current) {
            return $accumulator + ($current['serving_size'] * $current['caffeine_content']);
            //return bcadd($accumulator, bcmul($current['serving_size'], $current['caffeine_content']));
        }, 0);

        return collect([
            'total'      => $total,
            'amountLess' => max(0, (Drink::SAFE_LIMIT - $total)),
        ])->toJson();
    }
}
