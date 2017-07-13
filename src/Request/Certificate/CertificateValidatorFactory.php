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

use TravelloAlexaLibrary\Request\AlexaRequestInterface;

/**
 * Class CertificateValidatorFactory
 *
 * @package TravelloAlexaLibrary\Request\Certificate
 */
class CertificateValidatorFactory
{
    /**
     * @param string                     $certificateUrl
     * @param string                     $signature
     * @param AlexaRequestInterface      $alexaRequest
     * @param CertificateLoaderInterface $certificateLoader
     * @param bool                       $validateSignatureFlag
     *
     * @return CertificateValidator
     */
    public function create(
        string $certificateUrl,
        string $signature,
        AlexaRequestInterface $alexaRequest,
        CertificateLoaderInterface $certificateLoader,
        bool $validateSignatureFlag = true
    ) {
        return new CertificateValidator(
            $certificateUrl,
            $signature,
            $alexaRequest,
            $certificateLoader,
            $validateSignatureFlag
        );
    }
}
