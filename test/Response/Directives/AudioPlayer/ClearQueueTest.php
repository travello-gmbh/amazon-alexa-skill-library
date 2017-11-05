<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.audio/
 *
 */

namespace TravelloAlexaLibraryTest\Response\Directives\AudioPlayer;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Response\Directives\AudioPlayer\ClearQueue;

/**
 * Class ClearQueueTest
 *
 * @package TravelloAlexaLibraryTest\Response\Directives\AudioPlayer;
 */
class ClearQueueTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationClearBehaviourClearEnqueued()
    {
        $directive = new ClearQueue('CLEAR_ENQUEUED');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ENQUEUED',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationClearBehaviourClearAll()
    {
        $directive = new ClearQueue('CLEAR_ALL');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ALL',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }

    /**
     *
     */
    public function testInstantiationClearBehaviourUnknown()
    {
        $directive = new ClearQueue('UNKNOWN');

        $expected = [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => 'CLEAR_ALL',
        ];

        $this->assertEquals($expected, $directive->toArray());
        $this->assertEquals('AudioPlayer.ClearQueue', $directive->getType());
    }
}
