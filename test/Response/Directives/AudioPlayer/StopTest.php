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
use TravelloAlexaLibrary\Response\Directives\AudioPlayer\Stop;

/**
 * Class StopTest
 *
 * @package TravelloAlexaLibraryTest\Response\Directives\AudioPlayer;
 */
class StopTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $directive = new Stop();

        $expected = [
            'type' => 'AudioPlayer.Stop',
        ];

        $this->assertEquals($expected, $directive->toArray());
    }
}
