<?php

class Pair {
    public $first, $second;
    public function __construct($fst, $snd) {
        $this->first = $fst;
        $this->second = $snd;
    }
    public function fst() {
        return $_fst($this);
    }
    public function snd() {
        return $_snd($this);
    }
    public function curry($f) {
        return $_curry($f, $this->first, $this->second);
    }
    public function uncurry($f) {
        return $_uncurry($f, $this);
    }
}

$_fst = function($pair) {
    return $pair->first;
};

$_snd = function($pair) {
    return $pair->second;
};

$_curry = function($f, $x, $y) {
    return $f(new Pair($x, $y));
};

$_uncurry = function($f, $p) {
    return $f($p->first, $p->second);
};

?>
