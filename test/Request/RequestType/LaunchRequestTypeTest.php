<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;

/**
 * Class LaunchRequestTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class LaunchRequestTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';

        $launchRequest = new LaunchRequestType(
            $requestId,
            $timestamp,
            $locale
        );

        $this->assertEquals('LaunchRequest', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
    }
}
