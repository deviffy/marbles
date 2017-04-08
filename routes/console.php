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

    // Init the starting set and the groups
    $bag = [];
    $buckets = [];

    // Set the number of available colors and calculate the number of marbles
    $colorsCount = $this->ask('Number of colors');

    $marblesCount = $colorsCount * $colorsCount;
    $bucketsCount = $bucketCapacity = $colorsCount;

    // Fill the bag with marbles
    for ($c = 0; $c < $colorsCount; $c++) {
        $bag[$availableColors[$c]] = $this->ask('How many '.$availableColors[$c].' marbles are there?');
    }

    // Sort the marbles in the bag :)
    array_multisort($bag);

    // Run the algorithm
    $buckets = \App\Library\Algorithm::run($bag);

    // Return the filled buckets
    dd($buckets);

})->describe('Play with marbles');
