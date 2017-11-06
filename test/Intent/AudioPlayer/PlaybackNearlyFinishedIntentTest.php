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

namespace TravelloAlexaLibraryTest\Intent\AudioPlayer;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Intent\AudioPlayer\PlaybackNearlyFinishedIntent;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;

/**
 * Class PlaybackNearlyFinishedIntentTest
 *
 * @package TravelloAlexaLibraryTest\Intent\AudioPlayer
 */
class PlaybackNearlyFinishedIntentTest extends TestCase
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
                'type'                 => 'AudioPlayer.PlaybackNearlyFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'en-US',
                'token'                => '12345',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        $intent = new PlaybackNearlyFinishedIntent($alexaRequest, $alexaResponse, $textHelper);

        $this->assertTrue($intent instanceof AbstractIntent);
        $this->assertTrue($intent instanceof IntentInterface);
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
                'type'                 => 'AudioPlayer.PlaybackNearlyFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'en-US',
                'token'                => '12345',
                'offsetInMilliseconds' => 1000,
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper    = new TextHelper();
        $alexaResponse = new AlexaResponse();

        $smallImageUrl = 'https://image.server/small.png';
        $largeImageUrl = 'https://image.server/large.png';

        $intent = new PlaybackNearlyFinishedIntent($alexaRequest, $alexaResponse, $textHelper);
        $intent->handle($smallImageUrl, $largeImageUrl);

        $expected = [];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
