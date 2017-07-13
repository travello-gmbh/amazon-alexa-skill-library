<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Application\Helper;

/**
 * Abstract class AbstractTextHelper
 *
 * @package TravelloAlexaLibrary\Application\Helper
 */
abstract class AbstractTextHelper implements TextHelperInterface
{
    /** @var array */
    protected $commonTexts
        = [
            'alexaLaunchTitle'     => '',
            'alexaLaunchMessage'   => '',
            'alexaRepromptMessage' => '',
            'alexaHelpTitle'       => '',
            'alexaHelpMessage'     => '',
            'alexaCancelTitle'     => '',
            'alexaCancelMessage'   => '',
            'alexaStopTitle'       => '',
            'alexaStopMessage'     => '',
        ];

    /**
     * AbstractTextHelper constructor.
     *
     * @param array $commonTexts
     */
    public function __construct(array $commonTexts = [])
    {
        $this->commonTexts = array_merge($this->commonTexts, $commonTexts);
    }

    /**
     * Get the launch title
     *
     * @return string
     */
    public function getLaunchTitle(): string
    {
        return $this->commonTexts['alexaLaunchTitle'];
    }

    /**
     * Get the launch message
     *
     * @return string
     */
    public function getLaunchMessage(): string
    {
        return $this->commonTexts['alexaLaunchMessage'];
    }

    /**
     * Get the reprompt message
     *
     * @return string
     */
    public function getRepromptMessage(): string
    {
        return $this->commonTexts['alexaRepromptMessage'];
    }

    /**
     * Get the help title
     *
     * @return string
     */
    public function getHelpTitle(): string
    {
        return $this->commonTexts['alexaHelpTitle'];
    }

    /**
     * Get the help message
     *
     * @return string
     */
    public function getHelpMessage(): string
    {
        return $this->commonTexts['alexaHelpMessage'];
    }

    /**
     * Get the cancel title
     *
     * @return string
     */
    public function getCancelTitle(): string
    {
        return $this->commonTexts['alexaCancelTitle'];
    }

    /**
     * Get the cancel message
     *
     * @return string
     */
    public function getCancelMessage(): string
    {
        return $this->commonTexts['alexaCancelMessage'];
    }

    /**
     * Get the stop title
     *
     * @return string
     */
    public function getStopTitle(): string
    {
        return $this->commonTexts['alexaStopTitle'];
    }

    /**
     * Get the stop message
     *
     * @return string
     */
    public function getStopMessage(): string
    {
        return $this->commonTexts['alexaStopMessage'];
    }
}
