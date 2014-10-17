<?php

require_once("Monad.php");

abstract class Either implements Monad {
    public abstract function either($f, $g);
}

class Right extends Either {
    public $val;
    public function __construct($v) {
        $this->val = $v;
    }
    public function either($f, $g) {
        return $g($this->val);
    }
    public function fmap($f) {
        return new Right($f($this->val));
    }
    public function pure($v) {
        return new Right($v);
    }
    public function apply($af) {
        return $this->fmap($af->val);
    }
    public function ret($v) {
        return new Right($v);
    }
    public function bind($f) {
        return $f($this->val);
    }
}

class Left extends Either {
    public $val;
    public function __construct($v) {
        $this->val = $v;
    }
    public function either($f, $g) {
        return $f($this->val);
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
