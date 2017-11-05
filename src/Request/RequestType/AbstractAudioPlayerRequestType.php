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

namespace TravelloAlexaLibrary\Request\RequestType;

/**
 * Class AbstractAudioPlayerRequestType
 *
 * @package TravelloAlexaLibrary\Request\RequestType
 */
abstract class AbstractAudioPlayerRequestType extends AbstractRequestType
{
    /** @var string */
    protected $token;

    /** @var int */
    protected $offsetInMilliseconds;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getOffsetInMilliseconds(): int
    {
        return $this->offsetInMilliseconds;
    }
}
