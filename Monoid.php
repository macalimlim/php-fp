<?php

interface Monoid {
    public function mempty();
    public function mappend($m);
}

?>
