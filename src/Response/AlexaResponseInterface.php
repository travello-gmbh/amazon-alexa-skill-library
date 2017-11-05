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

namespace TravelloAlexaLibrary\Response;

use TravelloAlexaLibrary\Response\Card\CardInterface;
use TravelloAlexaLibrary\Response\Directives\DirectivesInterface;
use TravelloAlexaLibrary\Response\OutputSpeech\OutputSpeechInterface;
use TravelloAlexaLibrary\Session\SessionContainer;

/**
 * Interface AlexaResponseInterface
 *
 * @package TravelloAlexaLibrary\Response
 */
interface AlexaResponseInterface
{
    /**
     * Add a directive
     *
     * @param DirectivesInterface $directive
     */
    public function addDirective(DirectivesInterface $directive);

    /**
     * Set the output speech
     *
     * @param OutputSpeechInterface $outputSpeech
     */
    public function setOutputSpeech(OutputSpeechInterface $outputSpeech);

    /**
     * Set the card
     *
     * @param CardInterface $card
     */
    public function setCard(CardInterface $card);

    /**
     * Set the reprompt
     *
     * @param OutputSpeechInterface $reprompt
     */
    public function setReprompt(OutputSpeechInterface $reprompt);

    /**
     * @param SessionContainer $sessionContainer
     */
    public function setSessionContainer(SessionContainer $sessionContainer);

    /**
     * End the current session
     */
    public function endSession();

    /**
     * @return SessionContainer
     */
    public function getSessionContainer(): SessionContainer;

    /**
     * Render the response object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
