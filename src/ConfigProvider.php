<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary;

use TravelloAlexaLibrary\Middleware\InjectAlexaRequestMiddleware;
use TravelloAlexaLibrary\Middleware\InjectAlexaRequestMiddlewareFactory;
use TravelloAlexaLibrary\Middleware\InjectCertificateValidatorMiddleware;
use TravelloAlexaLibrary\Middleware\InjectCertificateValidatorMiddlewareFactory;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoader;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoaderFactory;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class ConfigProvider
 *
 * @package TravelloAlexaLibrary
 */
class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    CertificateLoader::class =>
                        CertificateLoaderFactory::class,

                    CertificateValidatorFactory::class =>
                        InvokableFactory::class,

                    InjectAlexaRequestMiddleware::class =>
                        InjectAlexaRequestMiddlewareFactory::class,

                    InjectCertificateValidatorMiddleware::class =>
                        InjectCertificateValidatorMiddlewareFactory::class,
                ],
            ],
        ];
    }
}
