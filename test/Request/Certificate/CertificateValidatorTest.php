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

namespace TravelloAlexaLibrary\Request\Certificate;

function openssl_verify()
{
    return true;
}

namespace TravelloAlexaLibraryTest\Request\Certificate;

// @codingStandardsIgnoreStart
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\MethodProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoader;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Request\Context\AudioPlayer;
use TravelloAlexaLibrary\Request\Context\Context;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\LaunchRequestType;
use TravelloAlexaLibrary\Request\Session\Application;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User;

// @codingStandardsIgnoreEnd

/**
 * Class CertificateValidatorTest
 *
 * @package TravelloAlexaLibraryTest\Request\Certificate
 */
class CertificateValidatorTest extends TestCase
{
    /**
     * @var string
     */
    private $certificateUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert-5.pem';

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
     * @return array
     */
    public function provideCertificateUrlData()
    {
        return [
            [
                'https://s3.amazonaws.com/echo.api/echo-api-cert-5.pem',
                false,
                '',
            ],
            [
                'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
                false,
                '',
            ],
            [
                'https://s3.amazonaws.com:443/echo.api/echo-api-cert.pem',
                false,
                '',
            ],
            [
                'https://s3.amazonaws.com/echo.api/../echo.api/echo-api-cert.pem',
                false,
                '',
            ],
            [
                'http://s3.amazonaws.com/echo.api/echo-api-cert.pem',
                true,
                'Invalid certificate url scheme',
            ],
            [
                'https://notamazon.com/echo.api/echo-api-cert.pem',
                true,
                'Invalid certificate url host',
            ],
            [
                'https://s3.amazonaws.com/EcHo.aPi/echo-api-cert.pem',
                true,
                'Invalid certificate url path',
            ],
            [
                'https://s3.amazonaws.com/invalid.path/echo-api-cert.pem',
                true,
                'Invalid certificate url path',
            ],
            [
                'https://s3.amazonaws.com:563/echo.api/echo-api-cert.pem',
                true,
                'Invalid certificate url port',
            ],
        ];
    }

    /**
     * @return array
     */
    public function provideTimeStampData()
    {
        return [
            [300, true],
            [200, true],
            [150, true],
            [140, true],
            [139, false],
            [130, false],
            [100, false],
            [30, false],
            [1, false],
        ];
    }

    /**
     *
     */
    public function testInstantiation()
    {
        $timestamp = date('Y-m-d\TH:i:s\Z', time());

        $alexaRequest = $this->createAlexaRequest($timestamp);

        /** @var CertificateLoader|ObjectProphecy $certificateLoader */
        $certificateLoader = $this->prophesize(CertificateLoader::class);

        $certificate = new CertificateValidator(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader->reveal()
        );

        $this->assertEquals(
            $this->certificateUrl,
            $certificate->getCertificateUrl()
        );

        $this->assertEquals($this->signature, $certificate->getSignature());

        $this->assertEquals($alexaRequest, $certificate->getAlexaRequest());
    }

    /**
     *
     */
    public function testValidateCertificate()
    {
        $timestamp = date('Y-m-d\TH:i:s\Z', time());

        $alexaRequest = $this->createAlexaRequest($timestamp);

        /** @var CertificateLoader|ObjectProphecy $certificateLoader */
        $certificateLoader = $this->prophesize(CertificateLoader::class);

        /** @var MethodProphecy $loadMethod */
        $loadMethod = $certificateLoader->load($this->certificateUrl);
        $loadMethod->shouldBeCalled()->willReturn(
            $this->getCertificateAsset()
        );

        $certificate = new CertificateValidator(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader->reveal()
        );

        $certificate->validate();
    }

    /**
     * @param string $certificateUrl
     * @param bool   $exception
     * @param string $message
     *
     * @dataProvider provideCertificateUrlData
     */
    public function testValidateCertificateUrl(
        string $certificateUrl,
        bool $exception,
        string $message
    ) {
        $timestamp = date('Y-m-d\TH:i:s\Z', time());

        $alexaRequest = $this->createAlexaRequest($timestamp);

        /** @var CertificateLoader|ObjectProphecy $certificateLoader */
        $certificateLoader = $this->prophesize(CertificateLoader::class);

        /** @var MethodProphecy $loadMethod */
        $loadMethod = $certificateLoader->load($certificateUrl);

        if ($exception) {
            $loadMethod->shouldNotBeCalled();
        } else {
            $loadMethod->shouldBeCalled()->willReturn(
                $this->getCertificateAsset()
            );
        }

        $certificate = new CertificateValidator(
            $certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader->reveal()
        );

        if ($exception) {
            $this->expectException(BadRequest::class);
            $this->expectExceptionMessage($message);
        }

        $certificate->validate();

        $this->assertFalse($exception);
    }

    /**
     * @param int  $seconds
     * @param bool $exception
     *
     * @dataProvider provideTimeStampData
     */
    public function testValidateTimeStamp(int $seconds, bool $exception)
    {
        $timestamp = date('Y-m-d\TH:i:s\Z', time() + $seconds);

        $alexaRequest = $this->createAlexaRequest($timestamp);

        /** @var CertificateLoader|ObjectProphecy $certificateLoader */
        $certificateLoader = $this->prophesize(CertificateLoader::class);

        /** @var MethodProphecy $loadMethod */
        $loadMethod = $certificateLoader->load($this->certificateUrl);

        if ($exception) {
            $loadMethod->shouldNotBeCalled();
        } else {
            $loadMethod->shouldBeCalled()->willReturn(
                $this->getCertificateAsset()
            );
        }

        $certificate = new CertificateValidator(
            $this->certificateUrl,
            $this->signature,
            $alexaRequest,
            $certificateLoader->reveal()
        );

        if ($exception) {
            $this->expectException(BadRequest::class);
            $this->expectExceptionMessage('Invalid timestamp');
        }

        $certificate->validate();

        $this->assertFalse($exception);
    }

    /**
     * @param string $timestamp
     *
     * @return AlexaRequest
     */
    private function createAlexaRequest(string $timestamp)
    {
        $application = new Application(
            'amzn1.ask.skill.2e078f15-c276-41c4-a382-a4fba4323ca4'
        );

        // @codingStandardsIgnoreStart
        $user = new User(
            'amzn1.ask.account.AF6S5KHAPVECZ2WW7GEUMM3LHNPSC6XWQKUM3YB4KNAXKARTXHOQGNM5ZU3L7LPCBWAFUFSFJHFUMGQHQHIQJB6SFIE73X22QF7WOAUGXLVHB3OVEJ5E4B76PQHJJUTHU54KM2SUWG7JG5YEXNQJ5XKG2XKGQW7OZ25G2V6TQTQKR2I2GNLN6UYVZKLDC4AF5WYCYGFQOZTMMHI'
        );
        // @codingStandardsIgnoreEnd

        $session = new Session(
            true,
            'amzn1.echo-api.session.a1be50b2-2e94-4dc1-913b-9901cbf76de7',
            $application,
            [],
            $user
        );

        $launchRequest = new LaunchRequestType(
            'amzn1.echo-api.request.f1ec5455-1c8f-4707-916c-5e96d23b0049',
            $timestamp,
            'de-DE'
        );

        $context = new Context(
            new AudioPlayer('IDLE')
        );

        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'amzn1.echo-api.session.a1be50b2-2e94-4dc1-913b-9901cbf76de7',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.2e078f15-c276-41c4-a382-a4fba4323ca4',
                ],
                'attributes'  => [],
                'user'        => [
                    // @codingStandardsIgnoreStart
                    'userId' => 'amzn1.ask.account.AF6S5KHAPVECZ2WW7GEUMM3LHNPSC6XWQKUM3YB4KNAXKARTXHOQGNM5ZU3L7LPCBWAFUFSFJHFUMGQHQHIQJB6SFIE73X22QF7WOAUGXLVHB3OVEJ5E4B76PQHJJUTHU54KM2SUWG7JG5YEXNQJ5XKG2XKGQW7OZ25G2V6TQTQKR2I2GNLN6UYVZKLDC4AF5WYCYGFQOZTMMHI',
                    // @codingStandardsIgnoreEnd
                ],
            ],
            'request' => [
                'type'      => 'LaunchRequest',
                'requestId' => 'amzn1.echo-api.request.f1ec5455-1c8f-4707-916c-5e96d23b0049',
                'timestamp' => $timestamp,
                'locale'    => 'de-DE',
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        return new AlexaRequest(
            'version',
            $launchRequest,
            $session,
            $context,
            json_encode($data)
        );
    }

    /**
     * @return string
     */
    private function getCertificateAsset()
    {
        return implode(file(__DIR__ . '/TestAssets/echo-api-cert-5.pem'), '');
    }
}
