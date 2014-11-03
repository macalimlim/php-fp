<?php

class Writer implements Monad {
    public $val;
    public $logs;
    public function __construct($v, $l) {
        $this->val = $v;
        $this->logs = $l;
    }
    public function fmap($f) {
        return new Writer($f($this->val));
    }
    public function pure($v) {
        return new Writer($v, AList::_empti());
    }
    public function apply($af) {
        return $this->fmap($af->val);
    }
    public abstract function _ret($v) {
        return new Writer($v, AList::_empti());
    }
    public function ret($v) {
        return Writer::_ret($v);
    }
    public function bind($f) {
        return $f($this->val, $this->logs);
    }
}

?>