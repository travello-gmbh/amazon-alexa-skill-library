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
 * Class Context
 *
 * @package TravelloAlexaLibrary\Request\Context
 */
class Context implements ContextInterface
{
    /** @var AudioPlayerInterface */
    private $audioPlayer;

    /** @var SystemInterface */
    private $system;

    /** @var DisplayInterface */
    private $display;

    /**
     * @param AudioPlayerInterface $audioPlayer
     */
    public function setAudioPlayer(AudioPlayerInterface $audioPlayer)
    {
        $this->audioPlayer = $audioPlayer;
    }

    /**
     * @return AudioPlayerInterface
     */
    public function getAudioPlayer()
    {
        return $this->audioPlayer;
    }

    /**
     * @param SystemInterface $system
     */
    public function setSystem(SystemInterface $system)
    {
        $this->system = $system;
    }

    /**
     * @return SystemInterface|null
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param DisplayInterface $display
     */
    public function setDisplay(DisplayInterface $display)
    {
        $this->display = $display;
    }

    /**
     * @return DisplayInterface
     */
    public function getDisplay()
    {
        return $this->display;
    }
}
