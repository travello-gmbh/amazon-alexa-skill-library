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

namespace TravelloAlexaLibraryTest\Application;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use TravelloAlexaLibrary\Configuration\SkillConfigurationInterface;
use TravelloAlexaLibrary\Intent\CancelIntent;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\LaunchIntent;
use TravelloAlexaLibrary\Intent\StopIntent;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Request\RequestType\SessionEndedRequestType;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\TextHelper\TextHelper;
use TravelloAlexaLibraryTest\Application\TestAsset\TestApplication;

/**
 * Class AlexaApplicationTest
 *
 * @package TravelloAlexaLibraryTest\Application
 */
class AlexaApplicationTest extends TestCase
{
    /**
     *
     */
    public function testHelpRequest()
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
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(HelpIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelpIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelpIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

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

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testIntentRequest()
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
                    'name' => 'name',
                ],
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has('name');
        $hasMethod->shouldBeCalled()->willReturn(false);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelpIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelpIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

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

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testLaunchRequest()
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
                'type'      => 'LaunchRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(LaunchRequestType::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(LaunchRequestType::NAME);
        $getMethod->shouldBeCalled()->willReturn(new LaunchIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>launchMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'launchTitle',
                    'text'  => 'launchMessage',
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

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testSessionEndedRequest()
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

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(SessionEndedRequestType::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(SessionEndedRequestType::NAME);
        $getMethod->shouldBeCalled()->willReturn(new StopIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testStopRequest()
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
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(StopIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(StopIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new StopIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testCancelRequest()
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
                    'name'  => 'AMAZON.CancelIntent',
                    'slots' => [],
                ],
            ],
        ];

        $alexaRequest  = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse = new AlexaResponse();
        $textHelper    = new TextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(CancelIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(CancelIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new CancelIntent($alexaRequest, $alexaResponse, $textHelper));

        /** @var SkillConfigurationInterface|ObjectProphecy $skillConfiguration */
        $skillConfiguration = $this->prophesize(SkillConfigurationInterface::class);

        /** @var MethodProphecy $getSmallImageUrlMethod */
        $getSmallImageUrlMethod = $skillConfiguration->getSmallImageUrl();
        $getSmallImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/small.png');

        /** @var MethodProphecy $getLargeImageUrlMethod */
        $getLargeImageUrlMethod = $skillConfiguration->getLargeImageUrl();
        $getLargeImageUrlMethod->shouldBeCalled()->willReturn('https://image.server/large.png');

        $application = new TestApplication(
            $alexaRequest, $alexaResponse, $intentManager->reveal(), $skillConfiguration->reveal()
        );

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>cancelMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'cancelTitle',
                    'text'  => 'cancelMessage',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
