<?php

class Misc {
    public static function id($x) {
        return $x;
    }
    public static function compose($f, $g) {
        return function($v) use ($f, $g) {
            return $f($g($v));
        };
    }
    public static function appop($f, $v) {
        return $f($v);
    }
}

?>