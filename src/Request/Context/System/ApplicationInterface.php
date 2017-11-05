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

namespace TravelloAlexaLibrary\Request\Context\System;

/**
 * Class Application
 *
 * @package TravelloAlexaLibrary\Request\Context\System
 */
interface ApplicationInterface
{
    /**
     * @return string
     */
    public function getApplicationId(): string;
}
