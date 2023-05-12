<?php

function find_summ($array_one, $array_two){
	$num_one = intval(implode("", array_reverse($array_one)));
	$num_two = intval(implode("", array_reverse($array_two)));
	return array_map('intval', array_reverse(str_split(strval($num_one + $num_two))));
}

$l1 = [2,4,3];
$l2 = [5,6,4];
var_dump(find_summ($l1, $l2));
