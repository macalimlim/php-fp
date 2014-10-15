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
        // Identity Law
        $av = new Just(5);
        $fn = function($x) {return $x;};
        $af = Maybe::_pure($fn);
        $v = new Just(5);
        $this->assertEquals($av->apply($af), $v);
    }
    public function testApplicativeLaw2() {
        // Homomorphism Law
        $fn = function($x) {return $x;};
        $af = Maybe::_pure($fn);
        $av = Maybe::_pure(5);
        $this->assertEquals($av->apply($af), Maybe::_pure($fn(5)));
    }
    public function testApplicativeLaw3() {
        // Interchange Law

    }
    public function testApplicativeLaw4() {
        // Composition Law
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
