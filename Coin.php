<?php
// csv read and write functions
include "csvrw.php";

// reads the csv file and looks at previous records
$csv = csv_read("CoinCsv.csv");
$Hmax = $csv[0][1];
$Tmax = $csv[1][1];
// print($Hmax . "\n");
// print($Tmax . "\n");


// Flips a coin n times and returns an array of the flips
function flip(int $n) {

    // array to store the flips
    $flips = [];

    // flips the coin n times
    for ($i = 0; $i < $n; $i++) {

        // random number to simulate a coin flip
        $flip = rand(0, 1);

        // if the number is 1, the coin is heads, if it is 0, the coin is tails
        if ($flip) {
            array_push($flips, "H");
            print("H ");
        } else {
            array_push($flips, "T");
            print("T ");
        }
    }
    return $flips;
}

// Finds the longest consecutive sequence of heads and tails in an array of coin flips
function Consecutive (array $flips) {
    $consecutive = 0;
    $Hmax = 0;
    $Tmax = 0;
    for ($i = 0; $i < count($flips); $i++) {

        // if the flip is heads, the consecutive counter is incremented
        if ($flips[$i] == "H") {
            $consecutive++;

            // if the consecutive counter is greater than the current max, the max is updated
            if ($consecutive > $Hmax) {
                $Hmax = $consecutive;
            }
        } else {
            // if the flip is tails, the consecutive counter is reset
            $consecutive = 0;
        }
    }

    // the same process is repeated for tails
    for ($i = 0; $i < count($flips); $i++) {
        if ($flips[$i] == "T") {
            $consecutive++;
            if ($consecutive > $Tmax) {
                $Tmax = $consecutive;
            }
        } else {
            $consecutive = 0;
        }
    }
    return [$Hmax, $Tmax];
}


// Main loop
While (true) {
    // clears the console
    system('cls');
    print("How many times would you like to flip the coin?\n");

    // reads the number of flips
    $n = (int)readline("->: ");

    // if the number of flips is invalid, the user is prompted to enter a valid number
    if ($n < 1 || $n > 1000) {
        print("Invalid number of flips.\n");
        continue;
    }

    // flips the coin and stores the results in an array
    $flips = flip($n);
    
    // finds the longest consecutive sequence of heads and tails
    $records = Consecutive($flips);
    print("\nThe longest consecutive sequence of heads was " . $records[0] . "\nThe longest consecutive sequence of tails was " . $records[1] . ".\n");

    // if the new record is greater than the previous record, the csv file is updated
    if ($records[0] > $Hmax) {
        print("New record for heads!: $records[0]\n");
        print("Old record: $Hmax\n");
        $csv[0][1] = $records[0];
        $Hmax = $records[0];
    }
    if ($records[1] > $Tmax) {
        print("New record for tails!: $records[1]\n");
        print("Old record: $Tmax\n");
        $csv[1][1] = $records[1];
        $Tmax = $records[1];
    }

    // writes the new records to the csv file
    csv_write($csv, "CoinCsv.csv");

    // asks the user if they would like to flip the coin again
    print("Would you like to flip the coin again? (y/n)\n");
    $option = strtolower(readline("->: "));
    if ($option == "n") {
        break;
    }
}
