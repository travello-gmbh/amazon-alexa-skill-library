<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Middleware;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class InjectAlexaRequestMiddlewareFactory
 *
 * @package TravelloAlexaLibrary\Middleware
 */
class InjectAlexaRequestMiddlewareFactory implements FactoryInterface
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
        $config = $container->get('config');

        $flag = false;

        if (isset($config['travello_alexa'])) {
            if (isset($config['travello_alexa']['log_requests'])) {
                $flag = $config['travello_alexa']['log_requests'];
            }
        }

        return new InjectAlexaRequestMiddleware(
            $flag
        );
    }
}
