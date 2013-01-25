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

    /**
     * @dataProvider terminatorBarLayoutProvider
     */
    public function testBarLayouts($character, $expectedBarLayout)
    {
        $character = new Character( $character );
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

    public function terminatorBarLayoutProvider()
    {
        return include __DIR__ . '/../fixtures/Character/bar-layouts.php';
    }
}
