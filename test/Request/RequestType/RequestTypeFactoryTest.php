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

namespace TravelloAlexaLibraryTest\Request\RequestType;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\AbstractAudioPlayerRequestType;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackFailedType;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackFinishedType;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackNearlyFinishedType;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackStartedType;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayerPlaybackStoppedType;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\RequestType\PlaybackControllerNextCommandIssuedType;
use TravelloAlexaLibrary\Request\RequestType\PlaybackControllerPauseCommandIssuedType;
use TravelloAlexaLibrary\Request\RequestType\PlaybackControllerPlayCommandIssuedType;
use TravelloAlexaLibrary\Request\RequestType\PlaybackControllerPreviousCommandIssuedType;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeInterface;
use TravelloAlexaLibrary\Request\RequestType\SessionEndedRequestType;

/**
 * Class RequestTypeFactoryTest
 *
 * @package TravelloAlexaLibraryTest\Request\RequestType
 */
class RequestTypeFactoryTest extends TestCase
{
    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithSlots()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name'  => 'name',
                    'slots' => [
                        'foo' => 'bar',
                    ],
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithoutSlots()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name' => 'name',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForIntentRequestTypeWithoutVersion()
    {
        $data = [
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'intent'    => [
                    'name' => 'name',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals('1.0', $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            IntentRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForLaunchRequestType()
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
                'locale'    => 'de-DE',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            LaunchRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSessionEndedRequestTypeWithError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'reason'    => 'reason',
                'error'     => [
                    'type'    => 'type',
                    'message' => 'message',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SessionEndedRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForSessionEndedRequestTypeWithoutError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'SessionEndedRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'reason'    => 'reason',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            SessionEndedRequestType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackStartedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackStarted',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackStartedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackStoppedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackStopped',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackStoppedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFinishedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFinishedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackNearlyFinishedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackNearlyFinished',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'offsetInMilliseconds' => 1000,
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackNearlyFinishedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFailedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'                 => 'AudioPlayer.PlaybackFailed',
                'requestId'            => 'requestId',
                'timestamp'            => '2017-01-27T20:29:59Z',
                'locale'               => 'de-DE',
                'token'                => '123456',
                'error'                => [
                    'type'    => 'type',
                    'message' => 'message',
                ],
                'currentPlaybackState' => [
                    'token'                => 'token',
                    'offsetInMilliseconds' => 1000,
                    'playerActivity'       => 'PLAYING',
                ],
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFailedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForAudioPlayerPlaybackFailedRequestTypeWithOutError()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'AudioPlayer.PlaybackFailed',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
                'token'     => '123456',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            AudioPlayerPlaybackFailedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerNextCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.NextCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerNextCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPauseCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PauseCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPauseCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPlayCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PlayCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPlayCommandIssuedType::class
        );
    }

    /**
     *
     */
    public function testFactoryForPlaybackControllerPreviousCommandIssuedRequestType()
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'applicationId',
                ],
                'attributes'  => [
                    'foo' => 'bar',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'PlaybackController.PreviousCommandIssued',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'de-DE',
            ],
        ];

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));

        $this->assertEquals($data['version'], $alexaRequest->getVersion());

        $this->assertSessionData($alexaRequest, $data);

        $this->assertRequestData(
            $alexaRequest->getRequest(),
            $data,
            PlaybackControllerPreviousCommandIssuedType::class
        );
    }

    /**
     * @param AlexaRequest $alexaRequest
     * @param array        $data
     */
    private function assertSessionData(AlexaRequest $alexaRequest, array $data)
    {
        $session = $alexaRequest->getSession();

        $this->assertEquals(
            $data['session']['new'],
            $session->isNew()
        );

        $this->assertEquals(
            $data['session']['sessionId'],
            $session->getSessionId()
        );

        $this->assertEquals(
            $data['session']['application']['applicationId'],
            $session->getApplication()->getApplicationId()
        );

        $this->assertEquals(
            $data['session']['attributes'] ?? [],
            $session->getAttributes()
        );

        $this->assertEquals(
            $data['session']['user']['userId'],
            $session->getUser()->getUserId()
        );
    }

    /**
     * @param RequestTypeInterface $requestType
     * @param array                $data
     * @param string               $requestTypeClass
     */
    private function assertRequestData(
        RequestTypeInterface $requestType,
        array $data,
        string $requestTypeClass
    ) {
        $this->assertEquals(
            $requestTypeClass,
            get_class($requestType)
        );

        $this->assertEquals(
            $data['request']['type'],
            $requestType->getType()
        );

        $this->assertEquals(
            $data['request']['requestId'],
            $requestType->getRequestId()
        );

        $this->assertEquals(
            $data['request']['timestamp'],
            $requestType->getTimestamp()
        );

        $this->assertEquals(
            $data['request']['locale'],
            $requestType->getLocale()
        );

        switch ($requestTypeClass) {
            case SessionEndedRequestType::class:
                /** @var SessionEndedRequestType $requestType */
                $this->assertEquals(
                    $data['request']['reason'],
                    $requestType->getReason()
                );

                if (isset($data['request']['error'])) {
                    $this->assertEquals(
                        $data['request']['error']['type'],
                        $requestType->getError()->getType()
                    );

                    $this->assertEquals(
                        $data['request']['error']['message'],
                        $requestType->getError()->getMessage()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getError()
                    );
                }
                break;

            case IntentRequestType::class:
                /** @var IntentRequestType $requestType */
                $this->assertEquals(
                    $data['request']['intent']['name'],
                    $requestType->getIntent()->getName()
                );

                if (isset($data['request']['intent']['slots'])) {
                    $this->assertEquals(
                        $data['request']['intent']['slots'],
                        $requestType->getIntent()->getSlots()
                    );
                }

                break;

            case AudioPlayerPlaybackStartedType::class:
            case AudioPlayerPlaybackStoppedType::class:
            case AudioPlayerPlaybackFinishedType::class:
            case AudioPlayerPlaybackNearlyFinishedType::class:
                /** @var AbstractAudioPlayerRequestType $requestType */
                $this->assertEquals(
                    $data['request']['token'],
                    $requestType->getToken()
                );

                $this->assertEquals(
                    $data['request']['offsetInMilliseconds'],
                    $requestType->getOffsetInMilliseconds()
                );

                break;

            case AudioPlayerPlaybackFailedType::class:
                /** @var AudioPlayerPlaybackFailedType $requestType */
                $this->assertEquals(
                    $data['request']['token'],
                    $requestType->getToken()
                );

                if (isset($data['request']['error'])) {
                    $this->assertEquals(
                        $data['request']['error']['type'],
                        $requestType->getError()->getType()
                    );

                    $this->assertEquals(
                        $data['request']['error']['message'],
                        $requestType->getError()->getMessage()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getError()
                    );
                }

                if (isset($data['request']['currentPlaybackState'])) {
                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['token'],
                        $requestType->getCurrentPlaybackState()->getToken()
                    );

                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['offsetInMilliseconds'],
                        $requestType->getCurrentPlaybackState()->getOffsetInMilliseconds()
                    );

                    $this->assertEquals(
                        $data['request']['currentPlaybackState']['playerActivity'],
                        $requestType->getCurrentPlaybackState()->getPlayerActivity()
                    );
                } else {
                    $this->assertNull(
                        $requestType->getCurrentPlaybackState()
                    );
                }

                break;
        }
    }
}
