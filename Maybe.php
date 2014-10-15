<?php

require("Monad.php");

abstract class Maybe implements Monad {
    public abstract function maybee($d, $f);
}

class Just extends Maybe {
    public $val;
    public function __construct($v) {
        $this->val = $v;
    }
    public function maybee($d, $f) {
        return $f($this->val);
    }
    public function fmap($f) {
        return new Just($f($this->val));
    }
    public function pure($v) {
        return new Maybe($v);
    }
    public function apply($af) {
        return $this->fmap($af->val);
    }
    public function ret($v) {
        return new Just($v);
    }
    public function bind($f) {
        return $f($this->$val);
    }
}

class Nothing extends Maybe {
    public function maybee($d, $f) {
        return $d;
    }
    public function fmap($f) {
        return $this;
    }
    public function pure($v) {
        return $this;
    }
    public function apply($af) {
        return $this;
    }
    public function ret($v) {
        return $this;
    }
    public function bind($f) {
        return $this;
    }
}

?>
