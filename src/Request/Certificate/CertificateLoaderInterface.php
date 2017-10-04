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

/**
 * Interface CertificateLoaderInterface
 *
 * @package TravelloAlexaLibrary\Request\Certificate
 */
interface CertificateLoaderInterface
{
    /**
     * @param string $certificateUrl
     *
     * @return string
     */
    public function load(string $certificateUrl): string;
}
