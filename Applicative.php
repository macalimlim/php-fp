<?php

require_once("Functor.php");

interface Applicative extends Functor {
    public function pure($v);
    public function apply($af);
}

?>
