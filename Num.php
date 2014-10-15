<?php

$_plus_ = function($x, $y) {
    return $x + $y;
};

$_multiply_ = function($x, $y) {
    return $x * $y;
};

$_minus_ = function($x, $y) {
    return $x - $y;
};

$_negate = function($x) {
    return 0 - $x;
};

$_abs = function($x) {
    return abs($x);
};

$_divide_ = function($x, $y) {
    return $x / $y;
};

$_mod_ = function($x, $y) {
    return $x % $y;
};

$_isEven = function($x) {
    return $x % 2 == 0;
};

$_isOdd = function($x) {
    return $x % 2 != 0;
};

?>
