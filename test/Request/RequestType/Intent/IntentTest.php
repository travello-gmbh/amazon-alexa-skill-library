<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Request\RequestType\Intent;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\Intent\Intent;

/**
 * Class IntentTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType\Intent
 */
class IntentTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals('name', $intent->getName());
        $this->assertEquals($slots, $intent->getSlots());
    }

    /**
     *
     */
    public function testSingleSlotValue()
    {
        $slots = [
            'foo' => [
                'name'  => 'foo',
                'value' => 'bar',
            ],
            'bar' => [
                'name'  => 'bar',
                'value' => 'foo',
            ],
        ];

        $intent = new Intent('name', $slots);

        $this->assertEquals(
            $slots['foo']['value'],
            $intent->getSlotValue('foo')
        );
        $this->assertEquals(
            $slots['bar']['value'],
            $intent->getSlotValue('bar')
        );
        $this->assertEquals(
            '',
            $intent->getSlotValue('foobar')
        );
    }
}
