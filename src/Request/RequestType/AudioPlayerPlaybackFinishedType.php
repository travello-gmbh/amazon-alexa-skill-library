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
 * Class AudioPlayerPlaybackFinishedType
 *
 * @package TravelloAlexaLibrary\Request\RequestType
 */
class AudioPlayerPlaybackFinishedType extends AbstractAudioPlayerRequestType
{
    const NAME = 'AudioPlayer.PlaybackFinished';

    /** @var string */
    private $type = 'AudioPlayer.PlaybackFinished';

    /**
     * AudioPlayerPlaybackFinishedType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     * @param string $token
     * @param int    $offsetInMilliseconds
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale,
        string $token,
        int $offsetInMilliseconds
    ) {
        $this->requestId            = $requestId;
        $this->timestamp            = $timestamp;
        $this->locale               = $locale;
        $this->token                = $token;
        $this->offsetInMilliseconds = $offsetInMilliseconds;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
