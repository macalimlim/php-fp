<?php

abstract class ABool {
    public static function _and($b1, $b2) {
        return $b1 && $b2;
    }
    public static function _or($b1, $b2) {
        return $b1 || $b2;
    }
    public static function _not($b) {
        return ! $b;
    }
}

?>
