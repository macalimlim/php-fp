<?php

require("Maybe.php");

class JustTest extends PHPUnit_Framework_TestCase {
    public function testFunctorLaw1() {
        // Identity Law
        $j = new Just(5);
        $fn = function($x) {return $x;};
        $res = new Just(5);
        $this->assertEquals($j->fmap($fn), $res);
    }
    public function testFunctorLaw2() {
        // Composition Law
    }
    public function testApplicativeLaw1() {
    }
    public function testApplicativeLaw2() {
    }
    public function testApplicativeLaw3() {
    }
    public function testApplicativeLaw4() {
    }
    public function testMonadLaw1() {
    }
    public function testMonadLaw2() {
    }
    public function testMonadLaw3() {
    }
    public function testMaybee() {
    }
    public function testFmap() {
    }
    public function testApply() {
    }
    public function testRet() {
    }
    public function testBind() {
    }
}

class NothingTest extends PHPUnit_Framework_TestCase {
    public function testFirstLaw() {
    }
    public function testSecondLaw() {
    }
    public function testThirdLaw() {
    }
    public function testMaybee() {
    }
    public function testFmap() {
    }
    public function testApply() {
    }
    public function testRet() {
    }
    public function testBind() {
    }
}

?>
