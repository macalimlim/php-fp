<?php

require("Eq.php");

interface Ord extends Eq {
    public function gt($x);
    public function gte($x);
    public function lt($x);
    public function lte($x);
    public function max($x);
    public function min($x);
}

$_gt_ = function($x, $y) {
    return $x > $y;
};

$_gte_ = function($x, $y) {
    return $x >= $y;
};

$_lt_ = function($x, $y) {
    return $x < $y;
};

$_lte_ = function($x, $y) {
    return $x <= $y;
};

$_max = function($x, $y) {
    if ($x >= $y) {
        return $x;
    } else {
        return $y;
    }
};

$_min = function($x, $y) {
    if ($x <= $y) {
        return $x;
    } else {
        return $y;
    }
};

?>
