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

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class HelpIntent
 *
 * @package TravelloAlexaLibrary\Intent
 */
class HelpIntent
{
    /** @var AlexaRequest */
    private $alexaRequest;

    /** @var AlexaResponse */
    private $alexaResponse;

    /**
     * HelpIntent constructor.
     *
     * @param AlexaRequest  $alexaRequest
     * @param AlexaResponse $alexaResponse
     */
    public function __construct(AlexaRequest $alexaRequest, AlexaResponse $alexaResponse)
    {
        $this->alexaRequest  = $alexaRequest;
        $this->alexaResponse = $alexaResponse;
    }

    /**
     * @return AlexaRequest
     */
    public function getAlexaRequest(): AlexaRequest
    {
        return $this->alexaRequest;
    }

    /**
     * @return AlexaResponse
     */
    public function getAlexaResponse(): AlexaResponse
    {
        return $this->alexaResponse;
    }

    /**
     * @param TextHelperInterface $textHelper
     * @param string              $smallImageUrl
     * @param string              $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(TextHelperInterface $textHelper, string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $title   = $textHelper->getHelpTitle();
        $message = $textHelper->getHelpMessage();

        $this->alexaResponse->setOutputSpeech(
            new SSML($message)
        );

        $this->alexaResponse->setCard(
            new Standard($title, $message, $smallImageUrl, $largeImageUrl)
        );

        $this->alexaResponse->setReprompt(
            new SSML($textHelper->getRepromptMessage())
        );

        return $this->alexaResponse;
    }
}
