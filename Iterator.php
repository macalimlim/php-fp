<?php

interface IIterator {
    public function hasNext();
    public function next();
}

interface IIterContainer {
    public function iterator();
}

?>