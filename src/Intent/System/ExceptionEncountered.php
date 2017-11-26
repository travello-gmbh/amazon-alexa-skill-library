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

namespace TravelloAlexaLibrary\Intent\System;

use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Response\AlexaResponse;

/**
 * Class ExceptionEncountered
 *
 * @package TravelloAlexaLibrary\Intent\System
 */
class ExceptionEncountered extends AbstractIntent
{
    const NAME = 'System.ExceptionEncountered';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        return $this->getAlexaResponse();
    }
}
