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

namespace TravelloAlexaLibrary\Response;

use TravelloAlexaLibrary\Response\Card\CardInterface;
use TravelloAlexaLibrary\Response\OutputSpeech\OutputSpeechInterface;

/**
 * Class AlexaResponse
 *
 * @package TravelloAlexaLibrary\Response
 */
class AlexaResponse implements AlexaResponseInterface
{
    /** @var CardInterface */
    private $card;

    /** @todo not implemented yet */
    private $directives;

    /** @var OutputSpeechInterface */
    private $outputSpeech;

    /** @var OutputSpeechInterface */
    private $reprompt;

    /** @var array */
    private $sessionAttributes = [];

    /** @var bool */
    private $shouldEndSession = false;

    /** @var string */
    private $version = '1.0';

    /**
     * Set the output speech
     *
     * @param OutputSpeechInterface $outputSpeech
     */
    public function setOutputSpeech(OutputSpeechInterface $outputSpeech)
    {
        $this->outputSpeech = $outputSpeech;
    }

    /**
     * Set the card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card)
    {
        $this->card = $card;
    }

    /**
     * Set the reprompt
     *
     * @param OutputSpeechInterface $reprompt
     */
    public function setReprompt(OutputSpeechInterface $reprompt)
    {
        $this->reprompt = $reprompt;
    }

    /**
     * Add session attributes
     *
     * @param array $attributes
     */
    public function addSessionAttributes(array $attributes = [])
    {
        foreach ($attributes as $attributeKey => $attributeValue) {
            $this->addSessionAttribute($attributeKey, $attributeValue);
        }
    }

    /**
     * Add session attribute
     *
     * @param string       $attributeKey
     * @param string|array $attributeValue
     */
    public function addSessionAttribute(
        string $attributeKey,
        $attributeValue
    ) {
        $this->sessionAttributes[$attributeKey] = $attributeValue;
    }

    /**
     * Append session attribute
     *
     * @param string $attributeKey
     * @param string $attributeValue
     */
    public function appendSessionAttribute(
        string $attributeKey,
        string $attributeValue
    ) {
        if (!is_array($this->sessionAttributes[$attributeKey])) {
            $this->sessionAttributes[$attributeKey]
                = [$this->sessionAttributes[$attributeKey]];
        }

        $this->sessionAttributes[$attributeKey][] = $attributeValue;
    }

    /**
     * Remove session attribute
     *
     * @param string $attributeKey
     */
    public function removeSessionAttribute(string $attributeKey)
    {
        if (isset($this->sessionAttributes[$attributeKey])) {
            unset($this->sessionAttributes[$attributeKey]);
        }
    }

    /**
     * End the current session
     */
    public function endSession()
    {
        $this->shouldEndSession = true;
    }

    /**
     * Render the response object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $response = [];

        if ($this->outputSpeech) {
            $response['outputSpeech'] = $this->outputSpeech->toArray();
        }

        if ($this->card) {
            $response['card'] = $this->card->toArray();
        }

        if ($this->reprompt) {
            $response['reprompt'] = [
                'outputSpeech' => $this->reprompt->toArray()
            ];
        }

        $response['shouldEndSession'] = $this->shouldEndSession;

        return [
            'version'           => $this->version,
            'sessionAttributes' => $this->sessionAttributes,
            'response'          => $response,
        ];
    }
}
