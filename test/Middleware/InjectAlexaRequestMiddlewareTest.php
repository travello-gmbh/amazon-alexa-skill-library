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

namespace TravelloAlexaLibraryTest\Middleware;

use Fig\Http\Message\RequestMethodInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use TravelloAlexaLibrary\Middleware\InjectAlexaRequestMiddleware;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;

/**
 * Class InjectAlexaRequestMiddlewareTest
 *
 * @package TravelloAlexaLibraryTest\Middleware
 */
class InjectAlexaRequestMiddlewareTest extends TestCase
{
    /**
     *
     */
    public function testWithGetRequest()
    {
        /** @var ServerRequestInterface|ObjectProphecy $request */
        $request = $this->prophesize(ServerRequestInterface::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $request->getMethod();
        $getMethod->shouldBeCalled()->willReturn(
            RequestMethodInterface::METHOD_GET
        );

        /** @var ResponseInterface|ObjectProphecy $response */
        $response = $this->prophesize(ResponseInterface::class)->reveal();

        /** @var DelegateInterface|ObjectProphecy $delegate */
        $delegate = $this->prophesize(DelegateInterface::class);
        $delegate->process($request->reveal())->willReturn($response);

        $middleware = new InjectAlexaRequestMiddleware();

        $result = $middleware->process($request->reveal(), $delegate->reveal());

        $this->assertSame($response, $result);
    }

    /**
     *
     */
    public function testWithPostRequest()
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

        $alexaRequest = RequestTypeFactory::createFromData(
            json_encode($data)
        );

        /** @var StreamInterface|ObjectProphecy $stream */
        $stream = $this->prophesize(StreamInterface::class);

        /** @var MethodProphecy $getContentsMethod */
        $getContentsMethod = $stream->getContents();
        $getContentsMethod->shouldBeCalled()->willReturn(json_encode($data));

        /** @var ServerRequestInterface|ObjectProphecy $request */
        $request = $this->prophesize(ServerRequestInterface::class);

        /** @var MethodProphecy $withAttributeMethod */
        $withAttributeMethod = $request->withAttribute(
            AlexaRequest::NAME,
            $alexaRequest
        );
        $withAttributeMethod->shouldBeCalled()->willReturn($request->reveal());

        /** @var MethodProphecy $getMethod */
        $getMethod = $request->getMethod();
        $getMethod->shouldBeCalled()->willReturn(
            RequestMethodInterface::METHOD_POST
        );

        /** @var MethodProphecy|StreamInterface $getHeaderMethod1 */
        $getHeaderMethod1 = $request->getHeaderLine('signaturecertchainurl');
        $getHeaderMethod1->shouldBeCalled()->willReturn(['foo']);

        /** @var MethodProphecy|StreamInterface $getBodyMethod */
        $getBodyMethod = $request->getBody();
        $getBodyMethod->shouldBeCalled()->willReturn($stream);

        /** @var ResponseInterface|ObjectProphecy $response */
        $response = $this->prophesize(ResponseInterface::class)->reveal();

        /** @var DelegateInterface|ObjectProphecy $delegate */
        $delegate = $this->prophesize(DelegateInterface::class);
        $delegate->process($request->reveal())->willReturn($response);

        $middleware = new InjectAlexaRequestMiddleware();

        $result = $middleware->process($request->reveal(), $delegate->reveal());

        $this->assertEquals($response, $result);
    }
}
