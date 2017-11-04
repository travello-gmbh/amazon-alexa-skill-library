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

namespace TravelloAlexaLibrary\Request\RequestType\AudioPlayer;

/**
 * Interface CurrentPlaybackStateInterface
 *
 * @package TravelloAlexaLibrary\Request\RequestType\AudioPlayer
 */
interface CurrentPlaybackStateInterface
{
    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return int
     */
    public function getOffsetInMilliseconds(): int;

    /**
     * @return string
     */
    public function getPlayerActivity(): string;
}
