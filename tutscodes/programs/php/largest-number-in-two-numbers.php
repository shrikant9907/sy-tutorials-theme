<?php
// Numbers
$number1 = 41;
$number2 = 80;

// Check if $number1 is greater than $number2
if ($number1 > $number2) {    // false
    $largestNumber = $number1;
} else {
    $largestNumber = $number2; // This value assigns to $largestNumber
}

// Display the result:
echo 'Result: The largest number is ' . $largestNumber;
?>