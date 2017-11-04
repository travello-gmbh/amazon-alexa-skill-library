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
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackNearlyFinishedType;

/**
 * Class AudioPlayerPlaybackNearlyFinishedTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class AudioPlayerPlaybackNearlyFinishedTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId            = 'requestId';
        $timestamp            = '2017-01-27T20:29:59Z';
        $locale               = 'de-DE';
        $token                = '123456';
        $offsetInMilliseconds = 100;

        $launchRequest = new AudioPlayerPlaybackNearlyFinishedType(
            $requestId,
            $timestamp,
            $locale,
            $token,
            $offsetInMilliseconds
        );

        $this->assertEquals('AudioPlayer.PlaybackNearlyFinished', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
        $this->assertEquals($token, $launchRequest->getToken());
        $this->assertEquals($offsetInMilliseconds, $launchRequest->getOffsetInMilliseconds());
    }
}
