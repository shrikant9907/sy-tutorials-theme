<?php

// Number
$number = 140;
$isPrimeNummber = false;

// Using for loop
for ($n = 2; $n < $number; $n++) {
    if($number%$n==0) {
        $isPrimeNummber = true;
        break;
    }
}

if ($isPrimeNummber) {
    echo "$number is prime number.";
} else {
    echo "$number is prime not number.";
}    