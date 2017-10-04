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

namespace TravelloAlexaLibrary\Response\Card;

/**
 * Interface CardInterface
 *
 * @package TravelloAlexaLibrary\Response\Card
 */
interface CardInterface
{
    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
