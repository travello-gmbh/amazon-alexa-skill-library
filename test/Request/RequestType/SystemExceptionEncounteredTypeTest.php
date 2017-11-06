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
use TravelloAlexaLibrary\Request\RequestType\Cause\Cause;
use TravelloAlexaLibrary\Request\RequestType\Error\Error;
use TravelloAlexaLibrary\Request\RequestType\SystemExceptionEncounteredType;

/**
 * Class SystemExceptionEncounteredTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class SystemExceptionEncounteredTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';
        $error     = new Error('type', 'message');
        $cause     = new Cause('requestId');

        $launchRequest = new SystemExceptionEncounteredType(
            $requestId,
            $timestamp,
            $locale,
            $error,
            $cause
        );

        $this->assertEquals('System.ExceptionEncountered', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
        $this->assertEquals($error, $launchRequest->getError());
        $this->assertEquals($cause, $launchRequest->getCause());
    }
}
