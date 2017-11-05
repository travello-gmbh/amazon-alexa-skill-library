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
 * Class AudioPlayer
 *
 * @package TravelloAlexaLibrary\Request\Context
 */
class AudioPlayer implements AudioPlayerInterface
{
    /** @var string */
    private $playerActivity;

    /** @var string */
    private $token;

    /** @var int */
    private $offsetInMilliseconds;

    /**
     * AudioPlayer constructor.
     *
     * @param string $playerActivity
     */
    public function __construct($playerActivity)
    {
        $this->playerActivity = $playerActivity;
    }

    /**
     * @return string
     */
    public function getPlayerActivity(): string
    {
        return $this->playerActivity;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param int $offsetInMilliseconds
     */
    public function setOffsetInMilliseconds(int $offsetInMilliseconds)
    {
        $this->offsetInMilliseconds = $offsetInMilliseconds;
    }

    /**
     * @return int|null
     */
    public function getOffsetInMilliseconds()
    {
        return $this->offsetInMilliseconds;
    }
}
