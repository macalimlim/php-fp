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
    public static function _ret($v) {
        return new IO($v);
    }
    public function ret($v) {
        return IO::_ret($v);
    }
    public function bind($f) {
        return $f($this->val);
    }
}

?>
