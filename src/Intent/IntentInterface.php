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

/**
 * Interface IntentInterface
 *
 * @package TravelloAlexaLibrary\Intent
 */
interface IntentInterface
{
    /**
     * @param TextHelperInterface $textHelper
     * @param string              $smallImageUrl
     * @param string              $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(
        TextHelperInterface $textHelper,
        string $smallImageUrl,
        string $largeImageUrl
    ): AlexaResponse;
}
