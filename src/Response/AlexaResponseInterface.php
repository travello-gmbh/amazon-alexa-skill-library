<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Response;

use TravelloAlexaLibrary\Response\Card\CardInterface;
use TravelloAlexaLibrary\Response\OutputSpeech\OutputSpeechInterface;

/**
 * Interface AlexaResponseInterface
 *
 * @package TravelloAlexaLibrary\Response
 */
interface AlexaResponseInterface
{
    /**
     * Add session attribute
     *
     * @param string       $attributeKey
     * @param string|array $attributeValue
     */
    public function addSessionAttribute(
        string $attributeKey,
        $attributeValue
    );

    /**
     * Add session attributes
     *
     * @param array $attributes
     */
    public function addSessionAttributes(array $attributes = []);

    /**
     * Append session attribute
     *
     * @param string $attributeKey
     * @param string $attributeValue
     */
    public function appendSessionAttribute(
        string $attributeKey,
        string $attributeValue
    );

    /**
     * End the current session
     */
    public function endSession();

    /**
     * Remove session attribute
     *
     * @param string $attributeKey
     */
    public function removeSessionAttribute(string $attributeKey);

    /**
     * Set the card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card);

    /**
     * Set the output speech
     *
     * @param OutputSpeechInterface $outputSpeech
     */
    public function setOutputSpeech(OutputSpeechInterface $outputSpeech);

    /**
     * Set the reprompt
     *
     * @param OutputSpeechInterface $reprompt
     */
    public function setReprompt(OutputSpeechInterface $reprompt);

    /**
     * Render the response object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
