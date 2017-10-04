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
use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Intent\CancelIntent;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\LaunchIntent;
use TravelloAlexaLibrary\Intent\StopIntent;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Request\RequestType\SessionEndedRequestType;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibraryTest\Application\TestAsset\Helper\TestTextHelper;
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(CertificateValidatorInterface::class);

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(HelpIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelpIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelpIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>help message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'help title',
                    'text'  => 'help message',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has('name');
        $hasMethod->shouldBeCalled()->willReturn(false);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(HelpIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new HelpIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>help message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'help title',
                    'text'  => 'help message',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
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
    public function testInvalidRequest()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldNotBeCalled();

        $alexaResponse = new AlexaResponse();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var TextHelperInterface|ObjectProphecy $textHelper */
        $textHelper = $this->prophesize(TextHelperInterface::class);

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper->reveal());
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $this->expectException(BadRequest::class);
        $this->expectExceptionMessage('Application Id invalid');

        $application->execute();
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(LaunchRequestType::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(LaunchRequestType::NAME);
        $getMethod->shouldBeCalled()->willReturn(new LaunchIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>launch message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'launch title',
                    'text'  => 'launch message',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(SessionEndedRequestType::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(SessionEndedRequestType::NAME);
        $getMethod->shouldBeCalled()->willReturn(new StopIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(StopIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(StopIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new StopIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
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

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        /** @var CertificateValidatorInterface|ObjectProphecy $certificateValidator */
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        /** @var ContainerInterface|ObjectProphecy $intentManager */
        $intentManager = $this->prophesize(ContainerInterface::class);

        /** @var MethodProphecy $hasMethod */
        $hasMethod = $intentManager->has(CancelIntent::NAME);
        $hasMethod->shouldBeCalled()->willReturn(true);

        /** @var MethodProphecy $getMethod */
        $getMethod = $intentManager->get(CancelIntent::NAME);
        $getMethod->shouldBeCalled()->willReturn(new CancelIntent($alexaRequest, $alexaResponse));

        $application = new TestApplication($alexaResponse, $intentManager->reveal(), $textHelper);
        $application->setAlexaRequest($alexaRequest);
        $application->setCertificateValidator($certificateValidator->reveal());

        $result = $application->execute();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>cancel message</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'cancel title',
                    'text'  => 'cancel message',
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
