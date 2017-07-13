<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Request;

use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeInterface;
use TravelloAlexaLibrary\Request\Session\SessionInterface;

/**
 * Interface AlexaRequest
 *
 * @package TravelloAlexaLibrary\Request
 */
interface AlexaRequestInterface
{
    /**
     * @param string $applicationId
     *
     * @throws BadRequest
     */
    public function checkApplication(string $applicationId);

    /**
     * @return string
     */
    public function getRawRequestData(): string;

    /**
     * @return RequestTypeInterface
     */
    public function getRequest(): RequestTypeInterface;

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface;

    /**
     * @return string
     */
    public function getVersion(): string;
}
