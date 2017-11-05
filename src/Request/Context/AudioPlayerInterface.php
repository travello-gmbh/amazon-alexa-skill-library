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

namespace TravelloAlexaLibrary\Request\Context;

/**
 * Interface AudioPlayer
 *
 * @package TravelloAlexaLibrary\Request\Context
 */
interface AudioPlayerInterface
{
    /**
     * @return string
     */
    public function getPlayerActivity(): string;

    /**
     * @param string $token
     */
    public function setToken(string $token);

    /**
     * @return string|null
     */
    public function getToken();

    /**
     * @param int $offsetInMilliseconds
     */
    public function setOffsetInMilliseconds(int $offsetInMilliseconds);

    /**
     * @return int|null
     */
    public function getOffsetInMilliseconds();
}
