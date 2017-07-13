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

namespace TravelloAlexaLibrary\Request\Certificate;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CertificateLoaderFactory
 *
 * @package TravelloAlexaLibrary\Request\Certificate
 */
class CertificateLoaderFactory implements FactoryInterface
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

        $cacheFlag = false;
        $cacheDir  = null;

        if (isset($config['travello_alexa'])) {
            if (isset($config['travello_alexa']['cache_flag'])) {
                $cacheFlag = $config['travello_alexa']['cache_flag'];
            }
            if (isset($config['travello_alexa']['cache_dir'])) {
                $cacheDir = $config['travello_alexa']['cache_dir'];
            }
        }

        return new CertificateLoader($cacheFlag, $cacheDir);
    }
}
