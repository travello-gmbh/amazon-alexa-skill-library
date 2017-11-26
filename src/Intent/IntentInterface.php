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

use TravelloAlexaLibrary\Response\AlexaResponse;

/**
 * Interface IntentInterface
 *
 * @package TravelloAlexaLibrary\Intent
 */
interface IntentInterface
{
    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse;
}
