<?php
namespace tests\Code39;

/**
 * Test-case for Code39\Character
 * @author David Desberg <david@daviddesberg.com>
 */
use Code39\Character;

class CharacterTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $character = new Character('a');
        $this->assertSame('a', strval($character));
    }

    public function testTerminatorCharacter()
    {
        $expectedBarLayout = array(
            array(1, true),
            array(3, false),
            array(1, true),
            array(1, false),
            array(3, true),
            array(1, false),
            array(3, true),
            array(1, false),
            array(1, true)
        );

        $character = new Character( chr(255) );
        $bars = $character->getBars();
        $this->assertCount(count($expectedBarLayout), $bars);

        for($i = 0; $i < count($bars); ++$i)
        {
            $this->assertSame($bars[$i]->getWidth(), $expectedBarLayout[$i][0]);
            $this->assertSame($bars[$i]->isBlack(), $expectedBarLayout[$i][1]);
        }
    }

    public function testInvalidCharacter()
    {
        $this->setExpectedException( 'InvalidArgumentException' );
        new Character( chr(129) );
    }
}
