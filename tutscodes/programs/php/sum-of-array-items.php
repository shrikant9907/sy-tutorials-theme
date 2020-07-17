<?php
$amounts = array(1000, 3000, 5000, 8000, 655, 800, 1000);

$sum = 0;
// Check if array has some items
if ($amounts) {

    // loop
    foreach($amounts as $amount) {
        // Adding the amount with sum    
        echo "Sum $sum + Amount $amount <br />";
        $sum = $sum + $amount;
    }   
    
}
echo '<hr />';
echo "Sum is: $sum";