<?php
// Numbers
$number1 = 100;
$number2 = 150;
$number3 = 800;

if ($number1 > $number2) {   // it returns false
    if ($number1 > $number3) {
        $largestNumber = $number1; 
    } else {
        $largestNumber = $number3; 
    }
} else {
    if ($number2 > $number3) { // it returns false
        $largestNumber = $number2; 
    } else {
        $largestNumber = $number3; // this value will assign to $largestNumber
    } 
}

// Display the result:
echo 'Result: The largest number is ' . $largestNumber;
?>