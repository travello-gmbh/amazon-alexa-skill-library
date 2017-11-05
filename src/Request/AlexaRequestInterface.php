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

namespace TravelloAlexaLibrary\Request;

use TravelloAlexaLibrary\Request\Context\ContextInterface;
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
    public function getVersion(): string;

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface;

    /**
     * @return RequestTypeInterface
     */
    public function getRequest(): RequestTypeInterface;

    /**
     * @return ContextInterface|null
     */
    public function getContext();

    /**
     * @return string
     */
    public function getRawRequestData(): string;
}
