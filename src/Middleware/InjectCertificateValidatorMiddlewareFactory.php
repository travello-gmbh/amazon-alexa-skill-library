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

use Interop\Container\ContainerInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateLoader;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorFactory;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class InjectCertificateValidatorMiddlewareFactory
 *
 * @package TravelloAlexaLibrary\Middleware
 */
class InjectCertificateValidatorMiddlewareFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null|null    $options
     *
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $certificateValidatorFactory = $container->get(CertificateValidatorFactory::class);

        $certificateLoader = $container->get(CertificateLoader::class);

        $config = $container->get('config');

        $flag = true;

        if (isset($config['travello_alexa'])) {
            if (isset($config['travello_alexa']['validate_signature'])) {
                $flag = $config['travello_alexa']['validate_signature'];
            }
        }

        return new InjectCertificateValidatorMiddleware(
            $certificateValidatorFactory,
            $certificateLoader,
            $flag
        );
    }
}
