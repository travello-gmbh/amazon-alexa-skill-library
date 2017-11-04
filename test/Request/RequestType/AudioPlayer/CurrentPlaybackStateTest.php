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

namespace TravelloAlexaLibraryTest\Request\RequestType\AudioPlayer;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayer\CurrentPlaybackState;

/**
 * Class CurrentPlaybackStateTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType\AudioPlayer
 */
class CurrentPlaybackStateTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $currentPlaybackState = new CurrentPlaybackState('PLAYING', 1000, '123456');

        $this->assertEquals('PLAYING', $currentPlaybackState->getPlayerActivity());
        $this->assertEquals(1000, $currentPlaybackState->getOffsetInMilliseconds());
        $this->assertEquals('123456', $currentPlaybackState->getToken());
    }
}
