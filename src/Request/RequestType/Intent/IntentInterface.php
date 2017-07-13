<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
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
