<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Request;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\Session\Application;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User;

class AlexaRequestTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');

        $user = new User('userId');

        $session = new Session(
            true,
            'sessionId',
            $application,
            ['foo' => 'bar'],
            $user
        );

        $launchRequest = new LaunchRequestType(
            'requestId',
            '2017-01-27T20:29:59Z',
            'de-DE'
        );

        $rawRequestData = json_encode(['foo' => 'bar']);

        $alexaRequest = new AlexaRequest(
            'version',
            $session,
            $launchRequest,
            $rawRequestData
        );

        $this->assertEquals('version', $alexaRequest->getVersion());
        $this->assertEquals($session, $alexaRequest->getSession());
        $this->assertEquals($launchRequest, $alexaRequest->getRequest());
        $this->assertEquals(
            $rawRequestData,
            $alexaRequest->getRawRequestData()
        );

        $alexaRequest->checkApplication('applicationId');

        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Application Id invalid');

        $alexaRequest->checkApplication('anotherApplicationId');
    }
}
