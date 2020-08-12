<?php

$array = array('id', 'model', 'brand', 'category', 'subcategory', 'company', 'quantity', 'price');


foreach ($array as $item) {
    echo '$inventory[\''.$item.'\'] = $'.$item.';<br>';
}


$numStories = 30;
$x=$numStories;
$y=$x%10;
$z=($x-$y)/10;
echo "$x<br>";
echo "$y<br>";
echo "$z<br>";
if($y!=0){
    $numPages=$z+1;
}
else{
    $numPages=$z;
}

echo $numPages;