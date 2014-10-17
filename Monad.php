<?php

require_once("Applicative.php");

interface Monad extends Applicative {
    public function ret($v);
    public function bind($f);
}

?>
