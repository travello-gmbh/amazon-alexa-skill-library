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

namespace TravelloAlexaLibrary\Middleware;

use Fig\Http\Message\RequestMethodInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoaderInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidator;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorFactory;

/**
 * Class InjectCertificateValidatorMiddleware
 *
 * @package TravelloAlexaLibrary\Middleware
 */
class InjectCertificateValidatorMiddleware implements ServerMiddlewareInterface
{
    /**
     * @var CertificateLoaderInterface
     */
    private $certificateLoader;
    /**
     * @var CertificateValidatorFactory
     */
    private $certificateValidatorFactory;
    /**
     * @var boolean
     */
    private $validateSignatureFlag = true;

    /**
     * InjectCertificateValidatorMiddleware constructor.
     *
     * @param CertificateValidatorFactory $certificateValidatorFactory
     * @param CertificateLoaderInterface  $certificateLoader
     * @param bool                        $validateSignatureFlag
     */
    public function __construct(
        CertificateValidatorFactory $certificateValidatorFactory,
        CertificateLoaderInterface $certificateLoader,
        $validateSignatureFlag
    ) {
        $this->certificateValidatorFactory = $certificateValidatorFactory;
        $this->certificateLoader           = $certificateLoader;
        $this->validateSignatureFlag       = $validateSignatureFlag;
    }

    /**
     * @param Request           $request
     * @param DelegateInterface $delegate
     *
     * @return mixed
     */
    public function process(Request $request, DelegateInterface $delegate)
    {
        if (
            $request->getMethod() == RequestMethodInterface::METHOD_POST
            && $request->getHeaderLine('signaturecertchainurl')
        ) {
            $certificateValidator = $this->certificateValidatorFactory->create(
                $request->getHeader('signaturecertchainurl')[0],
                $request->getHeader('signature')[0],
                $request->getAttribute(AlexaRequest::NAME),
                $this->certificateLoader,
                $this->validateSignatureFlag
            );

            $request = $request->withAttribute(
                CertificateValidator::NAME,
                $certificateValidator
            );
        }

        return $delegate->process($request);
    }
}
