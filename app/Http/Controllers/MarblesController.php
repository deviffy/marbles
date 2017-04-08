<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Color;
use App\Models\Result;

class MarblesController extends Controller
{
    public function index()
    {
        return view('setup');
    }

    public function pickColors(Request $request)
    {
        // Return an array of random color names
        $count = $request->input('count');
        return Color::inRandomOrder()->get()->take($count)->pluck('name')->toJson();
    }

    public function pickMarbles(Request $request)
    {
        // Retrieve input data
        $bag = $request->input('marbles');

        // Sort the marbles in the bag :)
        array_multisort($bag);

        // Run the algorithm
        $buckets = \App\Library\Algorithm::run($bag);

        // Save results to the database (Eloquent)
        Result::create([
            'marbles' => json_encode($bag),
            'buckets' => json_encode($buckets)
        ]);

        // Add color values and remap the array for prettier output
        $results = [];
        foreach ($buckets as $bucket) {
            $b = array_map(function($key, $value) {
                return [
                    'name' => $key,
                    'code' => \App\Models\Color::where('name', $key)->get()->pluck('code')[0],
                    'value' => $value
                ];
            }, array_keys($bucket), $bucket);

            $results[] = $b;
        }

        // Return the results
        return $results;
    }
}
