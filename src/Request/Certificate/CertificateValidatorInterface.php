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

use TravelloAlexaLibrary\Request\AlexaRequestInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;

/**
 * Interface CertificateValidatorInterface
 *
 * @package TravelloAlexaLibrary\Request\Certificate
 */
interface CertificateValidatorInterface
{
    /**
     * @return AlexaRequestInterface
     */
    public function getAlexaRequest(): AlexaRequestInterface;

    /**
     * @return string
     */
    public function getCertificateUrl(): string;

    /**
     * @return string
     */
    public function getSignature(): string;

    /**
     * @throws BadRequest
     */
    public function validate();
}
