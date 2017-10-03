<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Intent;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Intent\SessionEndedIntent;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibraryTest\Application\TestAsset\Helper\TestTextHelper;

/**
 * Class SessionEndedIntentTest
 *
 * @package TravelloAlexaLibraryTest\Intent
 */
class SessionEndedIntentTest extends TestCase
{
    /**
     * Test the instantiation of the class
     */
    public function testInstantiation()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'reason'    => 'reason',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $alexaResponse = new AlexaResponse();

        $sessionEndedIntent = new SessionEndedIntent($alexaRequest, $alexaResponse);

        $this->assertEquals($alexaRequest, $sessionEndedIntent->getAlexaRequest());
        $this->assertEquals($alexaResponse, $sessionEndedIntent->getAlexaResponse());
    }

    /**
     * Test the handling of the intent
     */
    public function testHandle()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'reason'    => 'reason',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $alexaResponse = new AlexaResponse();

        $textHelper    = new TestTextHelper();
        $smallImageUrl = 'https://image.server/small.png';
        $largeImageUrl = 'https://image.server/large.png';

        $sessionEndedIntent = new SessionEndedIntent($alexaRequest, $alexaResponse);
        $sessionEndedIntent->handle($textHelper, $smallImageUrl, $largeImageUrl);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stop message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stop title',
                    'text'  => 'stop message',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
