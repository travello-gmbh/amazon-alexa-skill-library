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
 * Class PlaybackControllerPreviousCommandIssuedType
 *
 * @package TravelloAlexaLibrary\Request\RequestType
 */
class PlaybackControllerPreviousCommandIssuedType extends AbstractRequestType
{
    const NAME = 'PlaybackController.PreviousCommandIssued';

    /** @var string */
    private $type = 'PlaybackController.PreviousCommandIssued';

    /**
     * PlaybackControllerPreviousCommandIssuedType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
