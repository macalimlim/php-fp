<?php

require("Bool.php");
require("Iterator.php");
require("Maybe.php");
//require("Monad.php");
require("Ord.php");
require("Pair.php");
require("Triple.php");

abstract class AList implements IIterContainer, Monad, Ord {

    public static function _eq($xs, $ys) {
        if (($xs instanceof ConsList) && ($ys instanceof ConsList)) {
            $b = $xs->head == $ys->head;
            if ($b) {
                return $b && AList::_eq($xs->rest, $ys->rest);
            } else {
                return false;
            }
        } elseif (($xs instanceof EmptyList) && ($ys instanceof EmptyList)) {
            return true;
        } else {
            return false;
        }
    }

    public abstract function cons($x);
    public static function _cons ($x, $xs) {
        return new ConsList($x, $xs);
    }

    public abstract function empti();
    public static function _empti() {
        return new EmptyList();
    }

    public abstract function append($xs);
    public static function _append($xs, $ys) {
        if (($xs instanceof EmptyList) && ($ys instanceof EmptyList)) {
            return AList::_empti();
        } elseif (($xs instanceof ConsList) && ($ys instanceof EmptyList)) {
            return $xs;
        } elseif (($xs instanceof EmptyList) && ($ys instanceof ConsList)) {
            return $ys;
        } elseif (($xs instanceof ConsList) && ($ys instanceof ConsList)) {
            return AList::_cons($xs->head, AList::_append($xs->rest, $ys));
        }
    }

    public abstract function head();
    public static function _head($xs) {
        if ($xs instanceof ConsList) {
            return $xs->head;
        } else {
            throw new Exception("head exception");
        }
    }

    public abstract function tail();
    public static function _tail($xs) {
        if ($xs instanceof ConsList) {
            return $xs->rest;
        } else {
            throw new Exception("tail exception");
        }
    }

    public abstract function last();
    public static function _last($xs) {
        if ($xs instanceof ConsList) {
            if ($xs->rest instanceof EmptyList) {
                return $xs->head;
            } else {
                return AList::_last($xs->rest);
            }
        } else {
            throw new Exception("last exception");
        }
    }

    public abstract function init();
    public static function _init($xs) {
        if ($xs instanceof ConsList) {
            if ($xs->rest instanceof EmptyList) {
                return AList::_empti();
            } else {
                return AList::_cons($xs->head, AList::_init($xs->rest));
            }
        } else {
            throw new Exception("init exception");
        }
    }

    public abstract function isEmpty();
    public static function _isEmpty($xs) {
        return $xs instanceof EmptyList;
    }

    public abstract function length();
    public static function _length($xs) {
        if ($xs instanceof ConsList) {
            return 1 + AList::_length($xs->rest);
        } else {
            return 0;
        }
    }

    public abstract function indexAt($n);
    public static function _indexAt($xs, $n) {
        if ($xs instanceof ConsList) {
            if ($n > 0) {
                return AList::_indexAt($xs->rest, $n - 1);
            } else {
                return $xs->head;
            }
        } else {
            throw new Exception("indexAt exception");
        }
    }

// iterate, repeat, replicate and cycle cannot be implemented here because of 'eager evaluation' :(

    public abstract function reverse();
    public static function _reverse($xs) {
        if ($xs instanceof ConsList) {
            return AList::_append(AList::_reverse($xs->rest), AList::_cons($xs->head, AList::_empti()));
        } else {
            return AList::_empti();
        }
    }

    public abstract function map($f);
    public static function _map($f, $xs) {
        if ($xs instanceof ConsList) {
            return AList::_cons($f($xs->head), AList::_map($f, $xs->rest));
        } else {
            return AList::_empti();
        }
    }

    public abstract function filter($f);
    public static function _filter($f, $xs) {
        if ($xs instanceof ConsList) {
            if ($f($xs->head)) {
                return AList::_cons($xs->head, AList::_filter($f, $xs->rest));
            } else {
                return AList::_filter($f, $xs->rest);
            }
        } else {
            return AList::_empti();
        }
    }

    public abstract function fold($f, $s);
    public static function _fold($f, $s, $xs) {
        if ($xs instanceof ConsList) {
            return AList::_fold($f, $f($s, $xs->head), $xs->rest);
        } else {
            return $s;
        }
    }

    public abstract function and_();
    public static function _and($xs) {
        $fn = function($x, $y) {return $x && $y;};
        return AList::_fold($fn, true, $xs);
    }

    public abstract function or_();
    public static function _or($xs) {
        $fn = function($x, $y) {return $x || $y;};
        return AList::_fold($fn, false, $xs);
    }

    public abstract function all($f);
    public static function _all($f, $xs) {
        return AList::_and(AList::_map($f, $xs));
    }

    public abstract function any($f);
    public static function _any($f, $xs) {
        return AList::_or(AList::_map($f, $xs));
    }

    public abstract function sum();
    public static function _sum($xs) {
        $fn = function($x, $y) {return $x + $y;};
        return AList::_fold($fn, 0, $xs);
    }

    public abstract function product();
    public static function _product($xs) {
        $fn = function($x, $y) {return $x * $y;};
        return AList::_fold($fn, 1, $xs);
    }

    public abstract function concat();
    public static function _concat($xs) {
        $fn = function($x, $y) {return AList::_append($x, $y);};
        return AList::_fold($fn, AList::_empti(), $xs);
    }

    public abstract function concatMap($f);
    public static function _concatMap($f, $xs) {
        $fn = function($s, $i) use ($f) {
            return AList::_append($s, $f($i));
        };
        return AList::_fold($fn, AList::_empti(), $xs);
    }

    public abstract function maximum();
    public static function _maximum($xs) {
        if ($xs instanceof ConsList) {
            $fn = function($x, $y) {return $x >= $y ? $x : $y;};
            return AList::_fold($fn, $xs->head, $xs);
        } else {
            throw new Exception("maximum exception");
        }
    }

    public abstract function minimum();
    public static function _minimum($xs) {
        if ($xs instanceof ConsList) {
            $fn = function($x, $y) {return $x <= $y ? $x : $y;};
            return AList::_fold($fn, $xs->head, $xs);
        } else {
            throw new Exception("minimum exception");
        }
    }

    public abstract function scan($f, $s);
    public static function _scan($f, $s, $xs) {
        if ($xs instanceof ConsList) {
            return AList::_cons($s, AList::_scan($f, $f($s, $xs->head), $xs->rest));
        } else {
            return AList::_cons($s, AList::_empti());
        }
    }

    public abstract function take($n);
    public static function _take($n, $xs) {
        if ($xs instanceof ConsList) {
            if ($n > 0) {
                return AList::_cons($xs->head, AList::_take($n - 1, $xs->rest));
            } else {
                return AList::_empti();
            }
        } else {
            return AList::_empti();
        }
    }

    public abstract function drop($n);
    public static function _drop($n, $xs) {
        if ($xs instanceof ConsList) {
            if ($n <= 0) {
                return AList::_cons($xs->head, $xs->rest);
            } else {
                return AList::_drop($n - 1, $xs->rest);
            }
        } else {
            return AList::_empti();
        }
    }

    public abstract function splitAt($n);
    public static function _splitAt($n, $xs) {
        return new Pair(AList::_take($n, $xs), AList::_drop($n, $xs));
    }

    public abstract function takeWhile($f);
    public static function _takeWhile($f, $xs) {
        if ($xs instanceof ConsList) {
            if ($f($xs->head)) {
                return AList::_cons($xs->head, AList::_takeWhile($f, $xs->rest));
            } else {
                return AList::_empti();
            }
        } else {
            return AList::_empti();
        }
    }

    public abstract function dropWhile($f);
    public static function _dropWhile($f, $xs) {
        if ($xs instanceof ConsList) {
            if ($f($xs->head)) {
                return AList::_dropWhile($f, $xs->rest);
            } else {
                return $xs;
            }
        } else {
            return AList::_empti();
        }
    }

    public abstract function span($f);
    public static function _span($f, $xs) {
        return new Pair(AList::_takeWhile($f, $xs), AList::_dropWhile($f, $xs));
    }

    public abstract function break_($f);
    public static function _break($f, $xs) {
        $nf = function($x) use ($f) { return ! $f($x); };
        return AList::_span($nf, $xs);
    }

    public abstract function isElem($x);
    public static function _isElem($x, $xs) {
        if ($xs instanceof ConsList) {
            if ($x == $xs->head) {
                return true;
            } else {
                return AList::_isElem($x, $xs->rest);
            }
        } else {
            return false;
        }
    }

    public abstract function isNotElem($x);
    public static function _isNotElem($x, $xs) {
        return ! AList::_isElem($x, $xs);
    }

    public abstract function lookUp($k);
    public static function _lookUp($k, $xs) {
        if ($xs instanceof ConsList) {
            if ($xs->head->first == $k) {
                return new Just($xs->head->second);
            } else {
                return AList::_lookUp($k, $xs->rest);
            }
        } else {
            return new Nothing();
        }
    }

    public abstract function zip($xs);
    public static function _zip($xs, $ys) {
        if (($xs instanceof ConsList) && ($ys instanceof ConsList)) {
            return AList::_cons(new Pair($xs->head, $ys->head), AList::_zip($xs->rest, $ys->rest));
        } else {
            return AList::_empti();
        }
    }

    public abstract function zip3($xs, $ys);
    public static function _zip3($xs, $ys, $zs) {
        if (($xs instanceof ConsList) && ($ys instanceof ConsList)
        && ($zs instanceof ConsList)) {
            return AList::_cons(new Triple($xs->head, $ys->head, $zs->head),
            AList::_zip3($xs->rest, $ys->rest, $zs->rest));
        } else {
            return AList::_empti();
        }
    }

    public abstract function zipWith($f, $xs);
    public static function _zipWith($f, $xs, $ys) {
        if (($xs instanceof ConsList) && ($ys instanceof ConsList)) {
            return AList::_cons($f($xs->head, $ys->head), AList::_zipWith($f, $xs->rest, $ys->rest));
        } else {
            return AList::_empti();
        }
    }

    public abstract function zipWith3($f, $xs, $ys);
    public static function _zipWith3($f, $xs, $ys, $zs) {
        if (($xs instanceof ConsList) && ($ys instanceof ConsList)
        && ($zs instanceof ConsList)) {
            return AList::_cons($f($xs->head, $ys->head, $zs->head), AList::_zipWith3($f, $xs->rest, $ys->rest, $zs->rest));
        } else {
            return AList::_empti();
        }
    }

    public abstract function unzip();
    public static function _unzip($xs) {
        if ($xs instanceof ConsList) {
            $uzxs = AList::_unzip($xs->rest);
            return new Pair(AList::_cons($xs->head->first, $uzxs->first), AList::_cons($xs->head->second, $uzxs->second));
        } else {
            return new Pair(AList::_empti(), AList::_empti());
        }
    }

    public abstract function unzip3();
    public static function _unzip3($xs) {
        if ($xs instanceof ConsList) {
            $uzxs = AList::_unzip3($xs->rest);
            $as = AList::_cons($xs->head->first, $uzxs->first);
            $bs = AList::_cons($xs->head->second, $uzxs->second);
            $cs = AList::_cons($xs->head->third, $uzxs->third);
            return new Triple($as, $bs, $cs);
        } else {
            return new Triple(AList::_empti(), AList::_empti(), AList::_empti());
        }
    }

    public static function arrayToLinkedList($arr) {
        $xs = AList::_empti();
        $arrr = array_reverse($arr);
        foreach ($arrr as $a) {
            $xs = $xs->cons($a);
        }
        return $xs;
    }

    public static function assocArrayToLinkedListOfPairs($arr) {
        $xs = AList::_empti();
        $arrr = array_reverse($arr, true);
        foreach ($arrr as $k => $v) {
            $xs = $xs->cons(new Pair($k ,$v));
        }
        return $xs;
    }

    public static function linkedListToArray($xs) {
        $arr = array();
        $it = $xs->iterator();
        print_r($it->hasNext());
        while ($it->hasNext()) {
            $arr[] = $it->next();
        }
        return $arr;
    }
}

class ConsList extends AList {
    public $head, $rest;
    public function __construct($x, $xs) {
        $this->head = $x;
        $this->rest = $xs;
    }
    public function iterator() {
        return new ListIterContainer($this);
    }
    public function fmap($f) {
        $this->map($f);
    }
    public function pure($v) {
    }
    public function apply($af) {
        $af->fold(function($s, $f) {
            return $_append($s, $this->fmap($f));
        }, $this->empti());
    }
    public function ret($v) {
        return $this->cons($v, $this->empti());
    }
    public function bind($f) {

    }
    public function eq($xs) {
        return AList::_eq($this, $xs);
    }
    public function neq($xs) {
    }
    public function gt($xs) {
    }
    public function gte($xs) {
    }
    public function lt($xs) {
    }
    public function lte($xs) {
    }
    public function max($x) {
    }
    public function min($x) {
    }
    public function cons($x) {
        return AList::_cons($x, $this);
    }
    public function empti() {
        return AList::_empti();
    }
    public function append($xs) {
        return AList::_append($this, $xs);
    }
    public function head() {
        return AList::_head($this);
    }
    public function tail() {
        return AList::_tail($this);
    }
    public function last() {
        return AList::_last($this);
    }
    public function init() {
        return AList::_init($this);
    }
    public function isEmpty() {
        return AList::_isEmpty($this);
    }
    public function length() {
        return AList::_length($this);
    }
    public function indexAt($n) {
        return AList::_indexAt($this, $n);
    }
    public function reverse() {
        return AList::_reverse($this);
    }
    public function map($f) {
        return AList::_map($f, $this);
    }
    public function filter($f) {
        return AList::_filter($f, $this);
    }
    public function fold($f, $s) {
        return AList::_fold($f, $s, $this);
    }
    public function and_() {
        return AList::_and($this);
    }
    public function or_() {
        return AList::_or($this);
    }
    public function all($f) {
        return AList::_all($f, $this);
    }
    public function any($f) {
        return AList::_any($f, $this);
    }
    public function sum() {
        return AList::_sum($this);
    }
    public function product() {
        return AList::_product($this);
    }
    public function concat() {
        return AList::_concat($this);
    }
    public function concatMap($f) {
        return AList::_concatMap($f, $this);
    }
    public function maximum() {
        return AList::_maximum($this);
    }
    public function minimum() {
        return AList::_minimum($this);
    }
    public function scan($f, $s) {
        return AList::_scan($f, $s, $this);
    }
    public function take($n) {
        return AList::_take($n, $this);
    }
    public function drop($n) {
        return AList::_drop($n, $this);
    }
    public function splitAt($n) {
        return AList::_splitAt($n, $this);
    }
    public function takeWhile($f) {
        return AList::_takeWhile($f, $this);
    }
    public function dropWhile($f) {
        return AList::_dropWhile($f, $this);
    }
    public function span($f) {
        return AList::_span($f, $this);
    }
    public function break_($f) {
        return AList::_break($f, $this);
    }
    public function isElem($x) {
        return AList::_isElem($x, $this);
    }
    public function isNotElem($x) {
        return AList::_isNotElem($x, $this);
    }
    public function lookUp($k) {
        return AList::_lookUp($k, $this);
    }
    public function zip($xs) {
        return AList::_zip($this, $xs);
    }
    public function zip3($xs, $ys) {
        return AList::_zip3($this, $xs, $ys);
    }
    public function zipWith($f, $xs) {
        return AList::_zipWith($f, $this, $xs);
    }
    public function zipWith3($f, $xs, $ys) {
        return AList::_zipWith3($f, $this, $xs, $ys);
    }
    public function unzip() {
        return AList::_unzip($this);
    }
    public function unzip3() {
        return AList::_unzip3($this);
    }
}

class EmptyList extends AList {
    public function iterator() {
        return new ListIterContainer($this);
    }
    public function fmap($f) {
        $this->map($f);
    }
    public function pure($v) {
    }
    public function apply($af) {
        $af->fold(function($s, $f) {
            return $_append($s, $this->fmap($f));
        }, $this->empti());
    }
    public function ret($v) {
        return $this->cons($v, $this->empti());
    }
    public function bind($f) {

    }
    public function eq($xs) {
        return AList::_eq($this, $xs);
    }
    public function neq($x) {
    }
    public function gt($x) {
    }
    public function gte($x) {
    }
    public function lt($x) {
    }
    public function lte($x) {
    }
    public function max($x) {
    }
    public function min($x) {
    }
    public function cons($x) {
        return AList::_cons($x, $this);
    }
    public function empti() {
        return AList::_empti();
    }
    public function append($xs) {
        return AList::_append($this, $xs);
    }
    public function head() {
        return AList::_head($this);
    }
    public function tail() {
        return AList::_tail($this);
    }
    public function last() {
        return AList::_last($this);
    }
    public function init() {
        return AList::_init($this);
    }
    public function isEmpty() {
        return AList::_isEmpty($this);
    }
    public function length() {
        return AList::_length($this);
    }
    public function indexAt($n) {
        return AList::_indexAt($this, $n);
    }
    public function reverse() {
        return AList::_reverse($this);
    }
    public function map($f) {
        return AList::_map($f, $this);
    }
    public function filter($f) {
        return AList::_filter($f, $this);
    }
    public function fold($f, $s) {
        return AList::_fold($f, $s, $this);
    }
    public function and_() {
        return AList::_and($this);
    }
    public function or_() {
        return AList::_or($this);
    }
    public function all($f) {
        return AList::_all($f, $this);
    }
    public function any($f) {
        return AList::_any($f, $this);
    }
    public function sum() {
        return AList::_sum($this);
    }
    public function product() {
        return AList::_product($this);
    }
    public function concat() {
        return AList::_concat($this);
    }
    public function concatMap($f) {
        return AList::_concatMap($f, $this);
    }
    public function maximum() {
        return AList::_maximum($this);
    }
    public function minimum() {
        return AList::_minimum($this);
    }
    public function scan($f, $s) {
        return AList::_scan($f, $s, $this);
    }
    public function take($n) {
        return AList::_take($n, $this);
    }
    public function drop($n) {
        return AList::_drop($n, $this);
    }
    public function splitAt($n) {
        return AList::_splitAt($n, $this);
    }
    public function takeWhile($f) {
        return AList::_takeWhile($f, $this);
    }
    public function dropWhile($f) {
        return AList::_dropWhile($f, $this);
    }
    public function span($f) {
        return AList::_span($f, $this);
    }
    public function break_($f) {
        return AList::_break($f, $this);
    }
    public function isElem($x) {
        return AList::_isElem($x, $this);
    }
    public function isNotElem($x) {
        return AList::_isNotElem($x, $this);
    }
    public function lookUp($i) {
        return AList::_lookUp($i, $this);
    }
    public function zip($xs) {
        return AList::_zip($this, $xs);
    }
    public function zip3($xs, $ys) {
        return AList::_zip3($this, $xs, $ys);
    }
    public function zipWith($f, $xs) {
        return AList::_zipWith($f, $this, $xs);
    }
    public function zipWith3($f, $xs, $ys) {
        return AList::_zipWith3($f, $this, $xs, $ys);
    }
    public function unzip() {
        return AList::_unzip($this);
    }
    public function unzip3() {
        return AList::_unzip3($this);
    }
}

class ListIterContainer implements IIterator {
    private $pos = 0;
    private $coll;
    public function __construct($c) {
        $this->coll = $c;
    }
    public function hasNext() {
        return $this->pos < $this->coll->length();
    }
    public function next() {
        return $this->coll->indexAt($this->pos++);
    }
}

?>
