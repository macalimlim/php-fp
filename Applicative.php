<?php

require("Functor.php");

interface Applicative extends Functor {
    public function apply($af);
}

?>
