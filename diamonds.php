<?php
function print_spaces($spaces, $gap){
    echo str_repeat(" ", $spaces + $gap);
}

function diamond($singleword){
	$length = strlen($singleword);
    $gap = (int)($length / 2);
    $n_iterations = $gap;

    for($i = 0; $i <= $n_iterations; $i++){
    	echo $length - 2*$gap;
    	$spaces = strlen($length) 
    	- strlen($length - 2*$gap) + 1;

    	print_spaces($spaces, $gap);

        for($j = $gap; $j < $length - $gap; $j++) 
        	echo $singleword[$j];

        $gap--;
        echo PHP_EOL;
    }

    $gap += 2;

    for($i = 0; $i < $n_iterations; $i++){
    	echo $length - 2*$gap;
    	$spaces = strlen($length) 
    	- strlen($length - 2*$gap) + 1;

        print_spaces($spaces, $gap);

        for($j = $gap; $j < $length - $gap; $j++) 
        	echo $singleword[$j];

        $gap++;
        echo PHP_EOL;
    }

}

for($i = 1; $i < $argc; $i++){
	diamond($argv[$i]);
	echo PHP_EOL;
}