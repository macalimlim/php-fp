<?php

require("Monad.php");

class IO implements Monad {
    public $val;
    public function __construct($v) {
        $this->val = $v;
    }
    public function fmap($f) {
        return new IO($f($this->val));
    }
    public function apply($af) {
        return $this->fmap($af->val);
    }
    public function ret($v) {
        return new IO($v);
    }
    public function bind($f) {
        return $f($this->val);
    }
}

?>
