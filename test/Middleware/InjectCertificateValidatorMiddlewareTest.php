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
use TravelloAlexaLibrary\Middleware\InjectCertificateValidatorMiddleware;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoader;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorFactory;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;

/**
 * Class InjectCertificateValidatorMiddlewareTest
 *
 * @package TravelloAlexaLibraryTest\Middleware
 */
class InjectCertificateValidatorMiddlewareTest extends TestCase
{
    /**
     * @var string
     */
    private $certificateUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert-4.pem';

    /**
     * @var string
     */
    private $signature
        = 'B/bxAdkIabkzsScfUsSfkz7pJrNLc1eoOOLk8qwG1ZudQRv7KcvyNa/91g74Z'
        . 'g3cRpifXEco4669MaZb4Cqs+vZ9TaTfftAMzy/Pc79AMuf1dU6GfUU7tp6cuav'
        . 'fqTD8cWlYN5TjEMCJbS1Y+VU929mX0edOZcZin7db6bOoZHu5gU8OSQ2r+6UMk8'
        . '8z5uuSjPyt9Du9vaC3Ics/Br30fEIplIgCt4y/UGRK76Rqo4L/DuNjty3o2m'
        . 'cU8bICK5xfZwCeH7b5UFwdjngtp8VfhKPtosZmCuWvMn+y9HoS06ll9cdI1FPLN'
        . '9w7KwMZFY8UzTc+0GfAwntxzlowAwkPhQ==';

    /**
     *
     */
    public function testWithGetRequest()
    {
        $certificateLoader = new CertificateLoader();

        $certificateValidatorFactory = new CertificateValidatorFactory();

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

        $middleware = new InjectCertificateValidatorMiddleware(
            $certificateValidatorFactory,
            $certificateLoader,
            false
        );

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

        $certificateLoader = new CertificateLoader();

        $certificateValidator = new CertificateValidator(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader,
            true
        );

        /** @var CertificateValidatorFactory|ObjectProphecy $certificateValidatorFactory */
        $certificateValidatorFactory = $this->prophesize(
            CertificateValidatorFactory::class
        );

        /** @var MethodProphecy $createMethod */
        $createMethod = $certificateValidatorFactory->create(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader,
            true
        );
        $createMethod->shouldBeCalled()->willReturn($certificateValidator);

        /** @var ServerRequestInterface|ObjectProphecy $request */
        $request = $this->prophesize(ServerRequestInterface::class);

        /** @var MethodProphecy $getMethod */
        $getMethod = $request->getMethod();
        $getMethod->shouldBeCalled()->willReturn(
            RequestMethodInterface::METHOD_POST
        );

        /** @var MethodProphecy|StreamInterface $getHeaderMethod1 */
        $getHeaderMethod1 = $request->getHeader('signaturecertchainurl');
        $getHeaderMethod1->shouldBeCalled()->willReturn(
            [$this->certificateUrl]
        );

        /** @var MethodProphecy|StreamInterface $getHeaderMethod2 */
        $getHeaderMethod2 = $request->getHeader('signature');
        $getHeaderMethod2->shouldBeCalled()->willReturn([$this->signature]);

        /** @var MethodProphecy|StreamInterface $getAttributeMethod */
        $getAttributeMethod = $request->getAttribute(AlexaRequest::NAME);
        $getAttributeMethod->shouldBeCalled()->willReturn($alexaRequest);

        /** @var MethodProphecy $withAttributeMethod */
        $withAttributeMethod = $request->withAttribute(
            CertificateValidator::NAME,
            $certificateValidator
        );
        $withAttributeMethod->shouldBeCalled()->willReturn($request->reveal());

        /** @var ResponseInterface|ObjectProphecy $response */
        $response = $this->prophesize(ResponseInterface::class)->reveal();

        /** @var DelegateInterface|ObjectProphecy $delegate */
        $delegate = $this->prophesize(DelegateInterface::class);
        $delegate->process($request->reveal())->willReturn($response);

        $middleware = new InjectCertificateValidatorMiddleware(
            $certificateValidatorFactory->reveal(),
            $certificateLoader,
            true
        );

        $result = $middleware->process($request->reveal(), $delegate->reveal());

        $this->assertEquals($response, $result);
    }
}
