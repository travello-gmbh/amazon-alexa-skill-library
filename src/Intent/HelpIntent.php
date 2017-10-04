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

namespace TravelloAlexaLibrary\Intent;

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class HelpIntent
 *
 * @package TravelloAlexaLibrary\Intent
 */
class HelpIntent extends AbstractIntent
{
    const NAME = 'AMAZON.HelpIntent';

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

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        $this->getAlexaResponse()->setCard(
            new Standard($title, $message, $smallImageUrl, $largeImageUrl)
        );

        $this->getAlexaResponse()->setReprompt(
            new SSML($textHelper->getRepromptMessage())
        );

        return $this->getAlexaResponse();
    }
}
