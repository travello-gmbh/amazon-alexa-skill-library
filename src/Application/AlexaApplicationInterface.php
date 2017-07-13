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

namespace TravelloAlexaLibrary\Application;

use TravelloAlexaLibrary\Request\AlexaRequestInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;

/**
 * Interface AlexaApplicationInterface
 *
 * @package TravelloAlexaLibrary\Application
 */
interface AlexaApplicationInterface
{
    /**
     * Execute the application
     *
     * @return array
     * @throws BadRequest
     */
    public function execute(): array;

    /**
     * @param AlexaRequestInterface $alexaRequest
     */
    public function setAlexaRequest(AlexaRequestInterface $alexaRequest);

    /**
     * @param CertificateValidatorInterface $certificateValidator
     */
    public function setCertificateValidator(
        CertificateValidatorInterface $certificateValidator
    );
}
