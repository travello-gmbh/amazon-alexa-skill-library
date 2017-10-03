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

namespace TravelloAlexaLibrary\Intent;

use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;

/**
 * Class AbstractIntent
 *
 * @package TravelloAlexaLibrary\Intent
 */
abstract class AbstractIntent implements IntentInterface
{
    /** @var AlexaRequest */
    private $alexaRequest;

    /** @var AlexaResponse */
    private $alexaResponse;

    /**
     * AbstractIntent constructor.
     *
     * @param AlexaRequest  $alexaRequest
     * @param AlexaResponse $alexaResponse
     */
    public function __construct(AlexaRequest $alexaRequest, AlexaResponse $alexaResponse)
    {
        $this->setAlexaRequest($alexaRequest);
        $this->setAlexaResponse($alexaResponse);
    }

    /**
     * @param AlexaRequest $alexaRequest
     */
    private function setAlexaRequest(AlexaRequest $alexaRequest)
    {
        $this->alexaRequest = $alexaRequest;
    }

    /**
     * @return AlexaRequest
     */
    protected function getAlexaRequest(): AlexaRequest
    {
        return $this->alexaRequest;
    }

    /**
     * @param AlexaResponse $alexaResponse
     */
    private function setAlexaResponse(AlexaResponse $alexaResponse)
    {
        $this->alexaResponse = $alexaResponse;
    }

    /**
     * @return AlexaResponse
     */
    protected function getAlexaResponse(): AlexaResponse
    {
        return $this->alexaResponse;
    }
}
