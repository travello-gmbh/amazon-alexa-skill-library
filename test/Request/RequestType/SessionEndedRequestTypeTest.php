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
use TravelloAlexaLibrary\Request\RequestType\Error\Error;
use TravelloAlexaLibrary\Request\RequestType\SessionEndedRequestType;

/**
 * Class SessionEndedRequestTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class SessionEndedRequestTypeTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';
        $reason    = 'reason';
        $error     = new Error('type', 'message');

        $sessionEndedRequest = new SessionEndedRequestType(
            $requestId,
            $timestamp,
            $locale,
            $reason,
            $error
        );

        $this->assertEquals(
            'SessionEndedRequest',
            $sessionEndedRequest->getType()
        );
        $this->assertEquals($requestId, $sessionEndedRequest->getRequestId());
        $this->assertEquals($timestamp, $sessionEndedRequest->getTimestamp());
        $this->assertEquals($locale, $sessionEndedRequest->getLocale());
        $this->assertEquals($reason, $sessionEndedRequest->getReason());
        $this->assertEquals($error, $sessionEndedRequest->getError());
    }
}
