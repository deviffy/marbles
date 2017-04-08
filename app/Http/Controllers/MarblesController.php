<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class MarblesController extends Controller
{
    public function index()
    {
        return view('setup');
    }

    public function pickColors(Request $request)
    {
        $count = $request->input('count');
        return Color::inRandomOrder()->get()->take($count)->pluck('name')->toJson();
    }

    public function pickMarbles(Request $request)
    {
        $colorSet = $request->input('colors');
        $bag = $request->input('marbles');

        // Init the buckets
        $buckets = [];

        // Set the number of available colors and calculate the number of marbles
        $colors = count($colorSet);
        $marbles = $colors * $colors;

        // Sort the marbles in the bag? :)
        array_multisort($this->bag, SORT_DESC);

        // Walk through the array and pick optimal number of marbles and put them in buckets
        while ($marbles > 0)
        {
            for ($i = 0; $i < $colors; $i++) {
                for ($j = 0; $j < 2; $j++) {
                    $marblesInBucket = isset($buckets[$i]) ? array_sum($buckets[$i]) : 0;
                    $neededInBucket = $colors - $marblesInBucket;

                    if ($marblesInBucket < $colors) {
                        $index = ($i + $j < $colors) ? $i + $j : 0;
                        $marble = array_keys($bag)[$index];

                        $optimalPick = floor($colors / 2) + (1 - $j);

                        if ($optimalPick > $neededInBucket) {
                            $optimalPick = $neededInBucket;
                        }

                        if ($bag[$marble] >= $optimalPick) {
                            $pick = $optimalPick;
                        } elseif ($bag[$marble] > 0) {
                            $pick = $bag[$marble];
                        } else {
                            $pick = 0;
                        }

                        if ($pick != 0) {
                            if (!isset($buckets[$i][$marble]))
                                $buckets[$i][$marble] = $pick;
                            else
                                $buckets[$i][$marble] += $pick;
                        }

                        $bag[$marble] -= $pick;
                        $marbles -= $pick;
                    }
                }
            }
        }

        // Return the filled buckets
        return $buckets;
    }
}
