<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
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
