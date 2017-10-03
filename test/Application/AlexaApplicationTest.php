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

namespace TravelloAlexaLibraryTest\Application;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
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
        $certificateValidator = $this->prophesize(
            CertificateValidatorInterface::class
        );

        /** @var MethodProphecy $validateMethod */
        $validateMethod = $certificateValidator->validate();
        $validateMethod->shouldBeCalled()->willReturn(true);

        $alexaResponse = new AlexaResponse();
        $textHelper    = new TestTextHelper();

        $application = new TestApplication($alexaResponse, $textHelper);
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

        $application = new TestApplication($alexaResponse, $textHelper);
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
                    'ssml' => '<speak>foo text</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'foo title',
                    'text'  => 'foo text',
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

        /** @var TextHelperInterface|ObjectProphecy $textHelper */
        $textHelper = $this->prophesize(TextHelperInterface::class);

        $application = new TestApplication($alexaResponse, $textHelper->reveal());
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

        $application = new TestApplication($alexaResponse, $textHelper);
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

        $application = new TestApplication($alexaResponse, $textHelper);
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
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
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

        $application = new TestApplication($alexaResponse, $textHelper);
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
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>reprompt message</speak>',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $result);
    }
}
