<?php
// Number
$number = 40;

// Check if reminder is Zero
if ($number%2 == 0) {    
    $type = "Even";
} else {
    $type = "Odd";
}

// Display the result:
echo 'Result: The number ' . $number .' is ' . $type;
?>