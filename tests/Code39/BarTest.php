<?php
namespace tests\Code39;

/**
 * Test-case for Code39\Bar
 * @author David Desberg <david@daviddesberg.com>
 */
use Code39\Bar;

class BarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $bar = new Bar(true, false);
        $this->assertSame(false, $bar->isBlack());
        $this->assertSame(3, $bar->getWidth());

        $bar = new Bar(false, true);
        $this->assertSame(true, $bar->isBlack());
        $this->assertSame(1, $bar->getWidth());
    }
}
