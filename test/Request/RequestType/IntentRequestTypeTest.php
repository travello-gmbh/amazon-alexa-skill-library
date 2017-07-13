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
use TravelloAlexaLibrary\Request\RequestType\Intent\Intent;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;

/**
 * Class IntentRequestTypeTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class IntentRequestTypeTest extends TestCase
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

        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';

        $intentRequest = new IntentRequestType(
            $requestId,
            $timestamp,
            $locale,
            $intent
        );

        $this->assertEquals('IntentRequest', $intentRequest->getType());
        $this->assertEquals($requestId, $intentRequest->getRequestId());
        $this->assertEquals($timestamp, $intentRequest->getTimestamp());
        $this->assertEquals($locale, $intentRequest->getLocale());
        $this->assertEquals($intent, $intentRequest->getIntent());
    }
}
