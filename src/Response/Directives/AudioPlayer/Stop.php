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
 * Class Stop
 *
 * @package TravelloAlexaLibrary\Response\Directives\AudioPlayer
 */
class Stop implements DirectivesInterface
{
    /** @var string */
    private $type = 'AudioPlayer.Stop';

    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
