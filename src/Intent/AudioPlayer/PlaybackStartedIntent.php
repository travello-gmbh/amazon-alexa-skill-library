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
use TravelloAlexaLibrary\Response\Directives\AudioPlayer\ClearQueue;

/**
 * Class PlaybackStartedIntent
 *
 * @package TravelloAlexaLibrary\Intent\AudioPlayer
 */
class PlaybackStartedIntent extends AbstractIntent
{
    const NAME = 'AudioPlayer.PlaybackStarted';

    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $this->getAlexaResponse()->addDirective(
            new ClearQueue(ClearQueue::CLEAR_BEHAVIOR_CLEAR_ENQUEUED)
        );

        $this->getAlexaResponse()->endSession();

        return $this->getAlexaResponse();
    }
}
