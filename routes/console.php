<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('marbles', function () {

    // Human friendly color names
    $availableColors = [
        'red', 'green', 'blue', 'yellow', 'orange', 'purple',
        'white', 'black', 'gray', 'lime', 'olive', 'teal'
    ];

    // Set the number of available colors and calculate the number of marbles
    $colors = $this->ask('Number of colors');
    $marbles = $colors * $colors;

    // Init the starting set and the groups
    $bag = [];
    $buckets = [];

    // Fill the bag with marbles
    for ($c = 0; $c < $colors; $c++) {
        $bag[$availableColors[$c]] = $this->ask('How many '.$availableColors[$c].' marbles are there?');
    }

    // Sort the marbles in the bag? :)
    array_multisort($bag, SORT_DESC);

    // Walk through the array and pick optimal number of marbles and put them in buckets
    while ($marbles > 0)
    {
        print_r($buckets);

        for ($i = 0; $i < $colors; $i++) {
            for ($j = 0; $j <= 1; $j++) {
                $colorsInBucket = isset($buckets[$i]) ? count($buckets[$i]) : 0;
                $marblesInBucket = isset($buckets[$i]) ? array_sum($buckets[$i]) : 0;
                $neededInBucket = $colors - $marblesInBucket;

                if ($marblesInBucket < $colors) {
                    if ($colorsInBucket < 3) {
                        // mergi mai departe pana la urmatorul valid
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

                        if ($pick > 0) {
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
    }

    // Return the filled buckets
    dd($buckets);



})->describe('Play with marbles');
