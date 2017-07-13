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
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
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
     * @param RequestTypeInterface|LaunchRequestType|SessionEndedRequestType|IntentRequestType $requestType
     * @param array                                                                            $data
     * @param string                                                                           $requestTypeClass
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
        }
    }
}
