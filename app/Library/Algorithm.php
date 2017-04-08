<?php

namespace App\Library;

class Algorithm
{
    public static function run ($bag)
    {
        $N = count(array_keys($bag));

        // Init the buckets
        $buckets = [];

        // Set the number of available colors, the number of marbles and the number of resulting buckets
        $marblesCount = $N * $N;
        $bucketsCount = $bucketCapacity = $N;

        // Set the optimal number of marbles to take out of the bag for each color
        $optimalPick = floor($bucketCapacity / 2) + 1;

        // Iterate through the buckets
        for ($b = 0; $b < $bucketsCount; $b++) {
            $marblesInBucket = 0;

            // Keep going through the marbles in the bag until the bucket is full
            while ($marblesInBucket < $bucketCapacity) {
                foreach ($bag as $k => $v) {
                    // Choose the optimal number of marbles from the bag
                    if ($v < $optimalPick || $bucketCapacity - $marblesInBucket < $v) {
                        $pick = $v;
                    } else {
                        $pick = $optimalPick;
                    }

                    // If we can't fill the bucket with this set of marbles move on
                    if ($marblesInBucket + $pick > $bucketCapacity) {
                        $pick = $bucketCapacity - $marblesInBucket;
                    } elseif ($marblesInBucket > 0 && $marblesInBucket + $pick < $bucketCapacity) {
                        continue;
                    }

                    // Place the marbles in the bucket
                    if ($pick > 0) {
                        if (isset($buckets[$b][$k])) {
                            $buckets[$b][$k] += $pick;
                        } else {
                            $buckets[$b][$k] = $pick;
                        }

                        // Remove the marbles from the bag
                        $marblesInBucket += $pick;
                        $bag[$k] -= $pick;
                    }
                }
            }
        }

        // Return the filled buckets
        return $buckets;
    }
}
