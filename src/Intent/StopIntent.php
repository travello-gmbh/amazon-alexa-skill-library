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

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class StopIntent
 *
 * @package TravelloAlexaLibrary\Intent
 */
class StopIntent extends AbstractIntent
{
    const NAME = 'AMAZON.StopIntent';

    /**
     * @param TextHelperInterface $textHelper
     * @param string              $smallImageUrl
     * @param string              $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(TextHelperInterface $textHelper, string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $title   = $textHelper->getStopTitle();
        $message = $textHelper->getStopMessage();

        $this->getAlexaResponse()->setOutputSpeech(
            new SSML($message)
        );

        $this->getAlexaResponse()->setCard(
            new Standard($title, $message, $smallImageUrl, $largeImageUrl)
        );

        $this->getAlexaResponse()->endSession();

        return $this->getAlexaResponse();
    }
}
