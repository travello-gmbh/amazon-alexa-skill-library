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

namespace TravelloAlexaLibrary\Request\RequestType\Intent;

/**
 * Interface Intent
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Intent
 */
interface IntentInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $key
     *
     * @return string
     */
    public function getSlotValue(string $key): string;

    /**
     * @return array
     */
    public function getSlots(): array;
}
