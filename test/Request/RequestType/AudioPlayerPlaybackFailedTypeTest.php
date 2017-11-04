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

namespace TravelloAlexaLibraryTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayer\CurrentPlaybackState;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackFailedType;
use TravelloAlexaLibrary\Request\RequestType\Error\Error;

/**
 * Class AudioPlayerPlaybackFailedTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class AudioPlayerPlaybackFailedTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';
        $token     = '123456';
        $error     = new Error('type', 'message');
        $currentPlaybackState = new CurrentPlaybackState('PLAYING', 1000, '1234567');

        $launchRequest = new AudioPlayerPlaybackFailedType(
            $requestId,
            $timestamp,
            $locale,
            $token,
            $error,
            $currentPlaybackState
        );

        $this->assertEquals('AudioPlayer.PlaybackFailed', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
        $this->assertEquals($token, $launchRequest->getToken());
        $this->assertEquals($error, $launchRequest->getError());
        $this->assertEquals($currentPlaybackState, $launchRequest->getCurrentPlaybackState());
    }
}
