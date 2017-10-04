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

namespace TravelloAlexaLibrary\Application\Helper;

/**
 * Interface AbstractTextHelper
 *
 * @package TravelloAlexaLibrary\Application\Helper
 */
interface TextHelperInterface
{
    /**
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale(string $locale);

    /**
     * Get the help message
     *
     * @return string
     */
    public function getHelpMessage(): string;

    /**
     * Get the help title
     *
     * @return string
     */
    public function getHelpTitle(): string;

    /**
     * Get the launch message
     *
     * @return string
     */
    public function getLaunchMessage(): string;

    /**
     * Get the launch title
     *
     * @return string
     */
    public function getLaunchTitle(): string;

    /**
     * Get the reprompt message
     *
     * @return string
     */
    public function getRepromptMessage(): string;

    /**
     * Get the cancel message
     *
     * @return string
     */
    public function getCancelMessage(): string;

    /**
     * Get the cancel title
     *
     * @return string
     */
    public function getCancelTitle(): string;

    /**
     * Get the stop message
     *
     * @return string
     */
    public function getStopMessage(): string;

    /**
     * Get the stop title
     *
     * @return string
     */
    public function getStopTitle(): string;
}
