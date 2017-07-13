<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Response\OutputSpeech;

/**
 * Interface PlainText
 *
 * @package TravelloAlexaLibrary\Response\OutputSpeech
 */
interface OutputSpeechInterface
{
    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
