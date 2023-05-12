<?php
function find_indices($nums, $target){
    for ($i = 0; $i < count($nums); $i++){
    	for ($j = 1; $j < count($nums); $j++){
        	if ($nums[$i] + $nums[$j] == $target){
                return [$i, $j];
            }
        }
    }
}


function find_indices_optimized($nums, $target) {
    $map = array();
    for ($i = 0; $i < count($nums); $i++) {
        $complement = $target - $nums[$i];
        if (isset($map[$complement])) {
            return array($map[$complement], $i);
        }
        $map[$nums[$i]] = $i;
    }
}



echo find_indices([1, 2, 3], 5)[1];
echo find_indices_optimized([1, 2, 3], 5)[1];