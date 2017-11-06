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

namespace TravelloAlexaLibrary\Intent\AudioPlayer;

use TravelloAlexaLibrary\Intent\AbstractIntent;
use TravelloAlexaLibrary\Response\AlexaResponse;

/**
 * Class PlaybackStoppedIntent
 *
 * @package TravelloAlexaLibrary\Intent\AudioPlayer
 */
class PlaybackStoppedIntent extends AbstractIntent
{
    const NAME = 'AudioPlayer.PlaybackStopped';

    /**
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     *
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        $this->getAlexaResponse()->setIsEmpty(true);

        return $this->getAlexaResponse();
    }
}