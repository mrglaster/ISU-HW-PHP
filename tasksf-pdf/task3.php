<?php
function find_median($nums1, $nums2) {
	$nums = array_merge($nums1, $nums2);	
	sort($nums);
	$count = count($nums);
	$mid = intdiv($count, 2);
	if ($count % 2 == 0) {
		return ($nums[$mid - 1] + $nums[$mid]) / 2;
	} else {
		return $nums[$mid];
	}
}



echo find_median([1, 3] , [2]) .  "\n";
echo find_median([1, 2] , [3, 4]);
?>