<?php

require("./List.php");

class ConsListTest extends PHPUnit_Framework_TestCase {
    public function testCons() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $this->assertEquals($xs, $ys);
        $this->assertEquals($ys, $xs);
        //
        $xs = AList::_empti()->cons(3);
        $ys = AList::_empti()->cons(3);
        $this->assertEquals($xs, $ys);
        $this->assertEquals($ys, $xs);
        //
        $xs = AList::_empti()->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(3)->cons(2)->cons(1);
        $this->assertEquals($xs, $ys);
        $this->assertEquals($ys, $xs);
        //
        $xs = AList::_empti()->cons(3)->cons(2)->cons(1)->cons(9);
        $ys = AList::_empti()->cons(3)->cons(2)->cons(1);
        $this->assertNotEquals($xs, $ys);
        $this->assertNotEquals($ys, $xs);
    }

    public function testEmpti() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $this->assertTrue($xs->eq($ys));
        $this->assertTrue($ys->eq($xs));
    }

    public function testAppend() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $this->assertEquals($xs->append($ys), $zs);
        $this->assertEquals($ys->append($xs), $zs);
        //
        $xs = AList::_empti();
        $ys = AList::_empti()->cons(1);
        $zs = AList::_empti()->cons(1);
        $this->assertEquals($xs->append($ys), $zs);
        $this->assertEquals($ys->append($xs), $zs);
        //
        $xs = AList::_empti()->cons(2)->cons(1);
        $ys = AList::_empti();
        $zs = AList::_empti()->cons(2)->cons(1);
        $this->assertEquals($xs->append($ys), $zs);
        $this->assertEquals($ys->append($xs), $zs);
        //
        $xs = AList::_empti()->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(5)->cons(4);
        $zs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $this->assertEquals($xs->append($ys), $zs);
        $this->assertNotEquals($ys->append($xs), $zs);
    }

    public function testHead() {
        //
        $xs = AList::_empti()->cons(3);
        $this->assertEquals($xs->head(), 3);
        //
        $xs = AList::_empti()->cons(2)->cons(1);
        $this->assertEquals($xs->head(), 1);
    }
    /**
     * @expectedException        Exception
     * @expectedExceptionMessage head exception
     */
    public function testHeadException() {
        //
        $xs = AList::_empti();
        $xs->head();
    }

    public function testTail() {
        //
        $xs = AList::_empti()->cons(1);
        $ys = AList::_empti();
        $this->assertEquals($xs->tail(), $ys);
        //
        $xs = AList::_empti()->cons(2)->cons(1);
        $ys = AList::_empti()->cons(2);
        $this->assertEquals($xs->tail(), $ys);
        //
        $xs = AList::_empti()->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(3)->cons(2);
        $this->assertEquals($xs->tail(), $ys);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage tail exception
     */
    public function testTailException() {
        //
        $xs = AList::_empti();
        $xs->tail();
    }

    public function testLast() {
        //
        $xs = AList::_empti()->cons(1);
        $this->assertEquals($xs->last(), 1);
        //
        $xs = AList::_empti()->cons(2)->cons(1);
        $this->assertEquals($xs->last(), 2);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage last exception
     */
    public function testLastException() {
        //
        $xs = AList::_empti();
        $xs->last();
    }

    public function testInit() {
        //
        $xs = AList::_empti()->cons(1);
        $ys = AList::_empti();
        $this->assertEquals($xs->init(), $ys);
        //
        $xs = AList::_empti()->cons(1)->cons(2);
        $ys = AList::_empti()->cons(2);
        $this->assertEquals($xs->init(), $ys);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $ys = AList::_empti()->cons(2)->cons(3);
        $this->assertEquals($xs->init(), $ys);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage init exception
     */
    public function testInitException() {
        //
        $xs = AList::_empti();
        $xs->init();
    }

    public function testIsEmpty() {
        //
        $xs = AList::_empti();
        $this->assertTrue($xs->isEmpty());
        //
        $xs = AList::_empti()->cons(1);
        $this->assertFalse($xs->isEmpty());
    }

    public function testLength() {
        //
        $xs = AList::_empti();
        $this->assertEquals($xs->length(), 0);
        //
        $xs = AList::_empti()->cons(2)->cons(5);
        $this->assertEquals($xs->length(), 2);
        //
        $xs = AList::_empti()->cons(2)->cons(3)->cons(5);
        $this->assertEquals($xs->length(), 3);
    }

    public function testIndexAt() {
        //
        $xs = AList::_empti()->cons(1);
        $this->assertEquals($xs->indexAt(0), 1);
        //
        $xs = AList::_empti()->cons(1)->cons(2);
        $this->assertEquals($xs->indexAt(1), 1);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $this->assertEquals($xs->indexAt(2), 1);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage indexAt exception
     */
    public function testIndexAtException() {
        //
        $xs = AList::_empti();
        $xs->indexAt(3);
        //
        $xs = AList::_empti()->cons(2);
        $xs->indexAt(3);
    }

    public function testReverse() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $this->assertEquals($xs->reverse(), $ys);
        $this->assertEquals($ys->reverse(), $xs);
        //
        $xs = AList::_empti()->cons(5);
        $ys = AList::_empti()->cons(5);
        $this->assertEquals($xs->reverse(), $ys);
        $this->assertEquals($ys->reverse(), $xs);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $ys = AList::_empti()->cons(3)->cons(2)->cons(1);
        $this->assertEquals($xs->reverse(), $ys);
        $this->assertEquals($ys->reverse(), $xs);
    }

    public function testMap() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $fn = function($x) {return $x;};
        $this->assertEquals($xs->map($fn), $ys);
        //
        $xs = AList::_empti()->cons(2)->cons(3)->cons(4);
        $ys = AList::_empti()->cons(4)->cons(6)->cons(8);
        $fn = function($x) {return $x * 2;};
        $this->assertEquals($xs->map($fn), $ys);
        //
        $xs = AList::_empti()->cons("mike")->cons("aya")->cons("kc");
        $ys = AList::_empti()->cons("hello mike")->cons("hello aya")->cons("hello kc");
        $fn = function($x) {return "hello ".$x;};
        $this->assertEquals($xs->map($fn), $ys);
    }

    public function testFilter() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $fn = function($x) {return $x;};
        $this->assertEquals($xs->filter($fn), $ys);
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(4)->cons(2);
        $fn = function($x) {return $x % 2 == 0;};
        $this->assertEquals($xs->filter($fn), $ys);
        //
        $xs = AList::_empti()->cons("mike")->cons("aya")->cons("kc");
        $ys = AList::_empti()->cons("aya");
        $fn = function($x) {return $x == "aya";};
        $this->assertEquals($xs->filter($fn), $ys);
    }

    public function testFold() {
        //
        $xs = AList::_empti();
        $fn = function($x, $y) {return $x + $y;};
        $this->assertEquals($xs->fold($fn, 0), 0);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $fn = function($x, $y) {return $x + $y;};
        $this->assertEquals($xs->fold($fn , 0), 6);
        //
        $xs = AList::_empti()->cons("web")->cons(" ")->cons("wide")->cons(" ")->cons("world")->cons(" ")->cons("hello");
        $fn = function($x, $y) {return $x . $y;};
        $this->assertEquals($xs->fold($fn , ""), "hello world wide web");
    }

    public function testAnd() {
        //
        $xs = AList::_empti();
        $this->assertTrue($xs->and_());
        //
        $xs = AList::_empti()->cons(true);
        $this->assertTrue($xs->and_());
        //
        $xs = AList::_empti()->cons(false);
        $this->assertFalse($xs->and_());
        //
        $xs = AList::_empti()->cons(true)->cons(true);
        $this->assertTrue($xs->and_());
        //
        $xs = AList::_empti()->cons(false)->cons(true);
        $this->assertFalse($xs->and_());
        //
        $xs = AList::_empti()->cons(true)->cons(true)->cons(true);
        $this->assertTrue($xs->and_());
        //
        $xs = AList::_empti()->cons(true)->cons(false)->cons(true);
        $this->assertFalse($xs->and_());
    }

    public function testOr() {
        //
        $xs = AList::_empti();
        $this->assertFalse($xs->or_());
        //
        $xs = AList::_empti()->cons(true);
        $this->assertTrue($xs->or_());
        //
        $xs = AList::_empti()->cons(false);
        $this->assertFalse($xs->or_());
        //
        $xs = AList::_empti()->cons(true)->cons(true);
        $this->assertTrue($xs->or_());
        //
        $xs = AList::_empti()->cons(false)->cons(true);
        $this->assertTrue($xs->or_());
        //
        $xs = AList::_empti()->cons(true)->cons(true)->cons(false);
        $this->assertTrue($xs->or_());
        //
        $xs = AList::_empti()->cons(false)->cons(false)->cons(false);
        $this->assertFalse($xs->or_());
    }

    public function testAll() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return true;};
        $this->assertTrue($xs->all($fn));
        //
        $xs = AList::_empti()->cons(2);
        $fn = function($x) {return $x == 2;};
        $this->assertTrue($xs->all($fn));
        //
        $xs = AList::_empti()->cons(5);
        $fn = function($x) {return $x == 3;};
        $this->assertFalse($xs->all($fn));
        //
        $xs = AList::_empti()->cons(2)->cons(2)->cons(2);
        $fn = function($x) {return $x == 2;};
        $this->assertTrue($xs->all($fn));
        //
        $xs = AList::_empti()->cons(5)->cons(3)->cons(1);
        $fn = function($x) {return $x == 2;};
        $this->assertFalse($xs->all($fn));
    }

    public function testAny() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return $x == 1;};
        $this->assertFalse($xs->any($fn));
        //
        $xs = AList::_empti()->cons(1);
        $fn = function($x) {return $x == 1;};
        $this->assertTrue($xs->any($fn));
        //
        $xs = AList::_empti()->cons(2);
        $fn = function($x) {return $x == 1;};
        $this->assertFalse($xs->any($fn));
        //
        $xs = AList::_empti()->cons(2)->cons(2)->cons(2);
        $fn = function($x) {return $x == 2;};
        $this->assertTrue($xs->any($fn));
        //
        $xs = AList::_empti()->cons(5)->cons(3)->cons(1);
        $fn = function($x) {return $x == 2;};
        $this->assertFalse($xs->any($fn));
    }

    public function testSum() {
        //
        $xs = AList::_empti();
        $this->assertEquals($xs->sum(), 0);
        //
        $xs = AList::_empti()->cons(2);
        $this->assertEquals($xs->sum(), 2);
        //
        $xs = AList::_empti()->cons(3)->cons(5);
        $this->assertEquals($xs->sum(), 8);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $this->assertEquals($xs->sum(), 6);
    }

    public function testProduct() {
        //
        $xs = AList::_empti();
        $this->assertEquals($xs->product(), 1);
        //
        $xs = AList::_empti()->cons(4);
        $this->assertEquals($xs->product(), 4);
        //
        $xs = AList::_empti()->cons(4)->cons(2);
        $this->assertEquals($xs->product(), 8);
        //
        $xs = AList::_empti()->cons(4)->cons(2)->cons(3);
        $this->assertEquals($xs->product(), 24);
    }

    public function testConcat() {
        //
        $xs = AList::_empti();
        $zs = AList::_empti();
        $this->assertEquals($xs->concat(), $zs);
        //
        $xs = AList::_empti()->cons(1);
        $ys = AList::_empti()->cons($xs);
        $zs = AList::_empti()->cons(1);
        $this->assertEquals($ys->concat(), $zs);
        //
        $xs1 = AList::_empti()->cons(1);
        $xs2 = AList::_empti()->cons(3)->cons(2);
        $ys = AList::_empti()->cons($xs1)->cons($xs2);
        $zs = AList::_empti()->cons(1)->cons(3)->cons(2);
        $this->assertEquals($ys->concat(), $zs);
    }

    public function testConcatMap() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return $x;};
        $ys = AList::_empti();
        $this->assertEquals($xs->concatMap($fn), $ys);
        //
        $xs = AList::_empti()->cons(4);
        $fn = function($x) {return AList::_empti()->cons($x * 2);};
        $ys = AList::_empti()->cons(8);
        $this->assertEquals($xs->concatMap($fn), $ys);
    }

    public function testMaximum() {
        //
        $xs = AList::_empti()->cons(4);
        $this->assertEquals($xs->maximum(), 4);
        //
        $xs = AList::_empti()->cons(1)->cons(3)->cons(2);
        $this->assertEquals($xs->maximum(), 3);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage maximum exception
     */
    public function testMaximumException() {
        //
        $xs = AList::_empti();
        $xs->maximum();
    }

    public function testMinimum() {
        //
        $xs = AList::_empti()->cons(4);
        $this->assertEquals($xs->minimum(), 4);
        //
        $xs = AList::_empti()->cons(1)->cons(3)->cons(2);
        $this->assertEquals($xs->minimum(), 1);
    }
    /**
     * @expectedException Exception
     * @expectedExceptionMessage minimum exception
     */
    public function testMinimumException() {
        //
        $xs = AList::_empti();
        $xs->minimum();
    }

    public function testScan() {
        //
        $xs = AList::_empti();
        $fn = function($s, $i) {return $s / $i;};
        $ys = AList::_empti()->cons(64.0);
        $this->assertEquals($xs->scan($fn, 64.0), $ys);
        //
        $xs = AList::_empti()->cons(4)->cons(2)->cons(4);
        $fn = function($s, $i) {return $s / $i;};
        $ys = AList::_empti()->cons(2.0)->cons(8.0)->cons(16.0)->cons(64.0);
        $this->assertEquals($xs->scan($fn, 64.0), $ys);
    }

    public function testTake() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $this->assertEquals($xs->take(2), $ys);
        //
        $xs = AList::_empti()->cons(2);
        $ys = AList::_empti()->cons(2);
        $this->assertEquals($xs->take(1), $ys);
        //
        $xs = AList::_empti()->cons(2);
        $ys = AList::_empti()->cons(2);
        $this->assertEquals($xs->take(2), $ys);
        //
        $xs = AList::_empti()->cons(2)->cons(4)->cons(1)->cons(5)->cons(3);
        $ys = AList::_empti()->cons(2)->cons(4)->cons(1)->cons(5)->cons(3);
        $this->assertEquals($xs->take(5), $ys);
    }

    public function testDrop() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $this->assertEquals($xs->drop(2), $ys);
        //
        $xs = AList::_empti()->cons(2);
        $ys = AList::_empti();
        $this->assertEquals($xs->drop(1), $ys);
        //
        $xs = AList::_empti()->cons(2);
        $ys = AList::_empti();
        $this->assertEquals($xs->drop(2), $ys);
        //
        $xs = AList::_empti()->cons(2)->cons(4)->cons(1)->cons(5)->cons(3);
        $ys = AList::_empti();
        $this->assertEquals($xs->drop(5), $ys);
        //
        $xs = AList::_empti()->cons(2)->cons(4)->cons(1)->cons(5)->cons(3);
        $ys = AList::_empti()->cons(2)->cons(4);
        $this->assertEquals($xs->drop(3), $ys);
    }

    public function testSplitAt() {
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(3)->cons(2)->cons(1);
        $zs = AList::_empti()->cons(5)->cons(4);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->splitAt(3), $p);
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(1);
        $zs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->splitAt(1), $p);
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(1);
        $zs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->splitAt(1), $p);
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti();
        $zs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->splitAt(0), $p);
        //
        $xs = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $ys = AList::_empti()->cons(5)->cons(4)->cons(3)->cons(2)->cons(1);
        $zs = AList::_empti();
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->splitAt(6), $p);
    }

    public function testTakeWhile() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return true;};
        $ys = AList::_empti();
        $this->assertEquals($xs->takeWhile($fn), $ys);
        //
        $xs = AList::_empti()->cons(1);
        $fn = function($x) {return $x == 1;};
        $ys = AList::_empti()->cons(1);
        $this->assertEquals($xs->takeWhile($fn), $ys);
        //
        $xs = AList::_empti()->cons(1)->cons(2);
        $fn = function($x) {return $x == 2;};
        $ys = AList::_empti()->cons(2);
        $this->assertEquals($xs->takeWhile($fn), $ys);
    }

    public function testDropWhile() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return true;};
        $ys = AList::_empti();
        $this->assertEquals($xs->dropWhile($fn), $ys);
        //
        $xs = AList::_empti()->cons(1);
        $fn = function($x) {return $x == 1;};
        $ys = AList::_empti();
        $this->assertEquals($xs->dropWhile($fn), $ys);
    }

    public function testSpan() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return True;};
        $p = new Pair(AList::_empti(), AList::_empti());
        $this->assertEquals($xs->span($fn), $p);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3)->cons(4)->cons(5);
        $fn = function($x) {return $x > 3;};
        $ys = AList::_empti()->cons(4)->cons(5);
        $zs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->span($fn), $p);
    }

    public function testBreak() {
        //
        $xs = AList::_empti();
        $fn = function($x) {return True;};
        $p = new Pair(AList::_empti(), AList::_empti());
        $this->assertEquals($xs->span($fn), $p);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3)->cons(4)->cons(5);
        $fn = function($x) {return $x > 3;};
        $ys = AList::_empti();
        $zs = AList::_empti()->cons(1)->cons(2)->cons(3)->cons(4)->cons(5);
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->break_($fn), $p);
    }

    public function testIsElem() {
        //
        $xs = AList::_empti();
        $this->assertFalse($xs->isElem(2));
        //
        $xs = AList::_empti()->cons(2);
        $this->assertTrue($xs->isElem(2));
        //
        $xs = AList::_empti()->cons(3);
        $this->assertFalse($xs->isElem(2));
    }

    public function testIsNotElem() {
        //
        $xs = AList::_empti();
        $this->assertTrue($xs->isNotElem(1));
        //
        $xs = AList::_empti()->cons(1);
        $this->assertFalse($xs->isNotElem(1));
        //
        $xs = AList::_empti()->cons(2);
        $this->assertTrue($xs->isNotElem(1));
    }

    public function testLookUp() {
        //
        $xs = AList::_empti();
        $m = new Nothing();
        $this->assertEquals($xs->lookUp(1), $m);
        //
        $xs = AList::_empti()->cons(new Pair(1, "one"));
        $m = new Just("one");
        $this->assertEquals($xs->lookUp(1), $m);
    }

    public function testZip() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $this->assertEquals($xs->zip($ys), $zs);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $ys = AList::_empti()->cons("one")->cons("two")->cons("three");
        $zs = AList::_empti()->cons(new Pair(1, "one"))->cons(new Pair(2, "two"))->cons(new Pair(3, "three"));
        $this->assertEquals($xs->zip($ys), $zs);
    }

    public function testZip3() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $as = AList::_empti();
        $this->assertEquals($xs->zip3($ys, $zs), $as);
        //
        $xs = AList::_empti()->cons(1);
        $ys = AList::_empti()->cons("one");
        $zs = AList::_empti()->cons("mike");
        $as = AList::_empti()->cons(new Triple(1, "one", "mike"));
        $this->assertEquals($xs->zip3($ys, $zs), $as);
    }

    public function testZipWith() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $fn = function($x, $y) {return $x + $y;};
        $zs = AList::_empti();
        $this->assertEquals($xs->zipWith($fn, $ys), $zs);
        //
        $xs = AList::_empti()->cons(1)->cons(2)->cons(3);
        $ys = AList::_empti()->cons("one")->cons("two")->cons("three");
        $fn = function($x, $y) {return $x . $y;};
        $zs = AList::_empti()->cons("1one")->cons("2two")->cons("3three");
        $this->assertEquals($xs->zipWith($fn, $ys), $zs);
    }

    public function testZipWith3() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $fn = function($x, $y, $z) {return $x + $y + $z;};
        $as = AList::_empti();
        $this->assertEquals($xs->zipWith3($fn, $ys, $zs), $as);
        //
        $xs = AList::_empti()->cons(1);
        $ys = AList::_empti()->cons("one");
        $zs = AList::_empti()->cons("mike");
        $fn = function($x, $y, $z) {return $x . $y . $z;};
        $as = AList::_empti()->cons("1onemike");
        $this->assertEquals($xs->zipWith3($fn, $ys, $zs), $as);
    }

    public function testUnzip() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->unzip(), $p);
        //
        $xs = AList::_empti()->cons(new Pair(1, "one"));
        $ys = AList::_empti()->cons(1);
        $zs = AList::_empti()->cons("one");
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->unzip(), $p);
        //
        $xs = AList::_empti()->cons(new Pair(1, "one"))->cons(new Pair(2, "two"))->cons(new Pair(3, "three"));
        $ys = AList::_empti()->cons(1)->cons(2)->cons(3);
        $zs = AList::_empti()->cons("one")->cons("two")->cons("three");
        $p = new Pair($ys, $zs);
        $this->assertEquals($xs->unzip(), $p);
    }

    public function testUnzip3() {
        //
        $xs = AList::_empti();
        $ys = AList::_empti();
        $zs = AList::_empti();
        $as = AList::_empti();
        $t = new Triple($ys, $zs, $as);
        $this->assertEquals($xs->unzip3(), $t);
        //
        $xs = AList::_empti()->cons(new Triple(1, "one", "mike"));
        $ys = AList::_empti()->cons(1);
        $zs = AList::_empti()->cons("one");
        $as = AList::_empti()->cons("mike");
        $t = new Triple($ys, $zs, $as);
        $this->assertEquals($xs->unzip3(), $t);
    }

    public function testArrayToLinkedList() {
        //
        $as = array();
        $xs = AList::_empti();
        $cas = AList::arrayToLinkedList($as);
        $this->assertEquals($cas, $xs);
        //
        $as = array(1, 2, 3);
        $xs = AList::_empti()->cons(3)->cons(2)->cons(1);
        $cas = AList::arrayToLinkedList($as);
        $this->assertEquals($cas, $xs);
    }
}

?>
