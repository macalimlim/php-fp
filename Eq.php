<?php

interface Eq {
    public function eq($x);
    public function neq($x);
}

$_eq_ = function($x, $y) {
    return $x == $y;
};

$_neq_ = function($x, $y) {
    return $x != $y;
};

?>
