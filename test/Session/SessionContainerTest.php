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

namespace Session;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\Session\Application;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User;
use TravelloAlexaLibrary\Session\SessionContainer;

/**
 * Class SessionContainerTest
 *
 * @package Session
 */
class SessionContainerTest extends TestCase
{
    public function testInstantiation()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $sessionContainer = new SessionContainer($defaults);

        $this->assertEquals($defaults, $sessionContainer->getAttributes());
    }

    public function testInitialization()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);

        $this->assertEquals($alexaRequest->getSession()->getAttributes(), $sessionContainer->getAttributes());
    }

    public function testResetting()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->resetAttributes();

        $this->assertEquals($defaults, $sessionContainer->getAttributes());
    }

    public function testAppending()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->appendAttribute('foo', 'foo');
        $sessionContainer->appendAttribute('bar', 'foobarfoo');

        $expected = [
            'foo' => [
                'bar',
                'foo',
            ],
            'bar' => [
                'foobar' => 'barfoo',
                'barfoo' => 'foobar',
                0        => 'foobarfoo',
            ],
        ];

        $this->assertEquals($expected, $sessionContainer->getAttributes());
    }

    public function testRemoving()
    {
        $defaults = [
            'foo' => null,
            'bar' => [],
        ];

        $alexaRequest = $this->createAlexaRequest();

        $sessionContainer = new SessionContainer($defaults);
        $sessionContainer->initAttributes($alexaRequest);
        $sessionContainer->removeAttribute('bar');

        $expected = [
            'foo' => 'bar',
        ];

        $this->assertEquals($expected, $sessionContainer->getAttributes());
    }

    /**
     * @return AlexaRequest
     */
    private function createAlexaRequest(): AlexaRequest
    {
        $application = new Application('applicationId');

        $user = new User('userId');

        $session = new Session(
            true,
            'sessionId',
            $application,
            [
                'foo' => 'bar',
                'bar' => [
                    'foobar' => 'barfoo',
                    'barfoo' => 'foobar',
                ],
            ],
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

        return $alexaRequest;
    }
}
