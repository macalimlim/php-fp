<?php

$_partial = function($f, $arg1) {
    $args = func_get_args();
    $f = array_shift($args);
    return function() use($f, $args) {
        $full_args = array_merge($args, func_get_args());
        return call_user_func_array($f, $full_args);
    };
};

?>
