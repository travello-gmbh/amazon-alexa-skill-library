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

namespace TravelloAlexaLibraryTest\Intent;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Configuration\SkillConfiguration;
use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Session\SessionContainer;
use TravelloAlexaLibrary\TextHelper\TextHelper;

/**
 * Class HelpIntentTest
 *
 * @package TravelloAlexaLibraryTest\Intent
 */
class HelpIntentTest extends TestCase
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.HelpIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest       = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse      = new AlexaResponse();
        $textHelper         = new TextHelper();
        $skillConfiguration = new SkillConfiguration();

        $helpIntent = new HelpIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);

        $this->assertTrue($helpIntent instanceof AbstractIntent);
        $this->assertTrue($helpIntent instanceof IntentInterface);
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
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.HelpIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setSmallImageUrl('https://image.server/small.png');
        $skillConfiguration->setLargeImageUrl('https://image.server/large.png');

        $helpIntent = new HelpIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $helpIntent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>helpMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'helpTitle',
                    'text'  => 'helpMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>repromptMessage</speak>',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
