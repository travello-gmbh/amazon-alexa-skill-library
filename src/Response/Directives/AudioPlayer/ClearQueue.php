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

namespace TravelloAlexaLibrary\Response\Directives\AudioPlayer;

use TravelloAlexaLibrary\Response\Directives\DirectivesInterface;

/**
 * Class ClearQueue
 *
 * @package TravelloAlexaLibrary\Response\Directives\AudioPlayer
 */
class ClearQueue implements DirectivesInterface
{
    const CLEAR_BEHAVIOR_CLEAR_ENQUEUED = 'CLEAR_ENQUEUED';
    const CLEAR_BEHAVIOR_CLEAR_ALL = 'CLEAR_ALL';

    /** @var string */
    protected $clearBehavior;

    /**
     * ClearQueue constructor.
     *
     * @param string $clearBehavior
     */
    public function __construct($clearBehavior)
    {
        $this->setClearBehavior($clearBehavior);
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'          => 'AudioPlayer.ClearQueue',
            'clearBehavior' => $this->clearBehavior,
        ];
    }

    /**
     * @param $clearBehavior
     */
    private function setClearBehavior($clearBehavior)
    {
        $this->clearBehavior = $clearBehavior;

        switch ($clearBehavior) {
            case self::CLEAR_BEHAVIOR_CLEAR_ALL:
            case self::CLEAR_BEHAVIOR_CLEAR_ENQUEUED:
                $this->clearBehavior = $clearBehavior;
                break;

            default:
                $this->clearBehavior = self::CLEAR_BEHAVIOR_CLEAR_ALL;
        }
    }
}
