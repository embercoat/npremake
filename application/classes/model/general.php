<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_general extends Model {
	function round_custom($int, $precision){
	    $base = $int-($int%$precision);
	    return ($int % $precision > $precision / 2)?$base+$precision:$base;
	}
}
