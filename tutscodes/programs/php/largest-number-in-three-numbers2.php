<?php
// Numbers
$number1 = 20;
$number2 = 50;
$number3 = 30;

// Check if $number1 is greater than $number2 and $number3
if (($number1 > $number2) && ($number1 > $number3)) { // false
    $largestNumber = $number1; 
} else if ($number2 > $number3) { // true
    $largestNumber = $number2;  
} else {
    // It will assign $number3 if none of the above 2 numbers greater.
    $largestNumber = $number3; 
}

// Display the result:
echo 'Result: The largest number is ' . $largestNumber;
?>