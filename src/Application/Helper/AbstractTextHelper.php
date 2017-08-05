<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
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
    /** @var string */
    protected $locale = 'en-US';

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
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get the launch title
     *
     * @return string
     */
    public function getLaunchTitle(): string
    {
        return $this->commonTexts[$this->locale]['alexaLaunchTitle'];
    }

    /**
     * Get the launch message
     *
     * @return string
     */
    public function getLaunchMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaLaunchMessage'];
    }

    /**
     * Get the reprompt message
     *
     * @return string
     */
    public function getRepromptMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaRepromptMessage'];
    }

    /**
     * Get the help title
     *
     * @return string
     */
    public function getHelpTitle(): string
    {
        return $this->commonTexts[$this->locale]['alexaHelpTitle'];
    }

    /**
     * Get the help message
     *
     * @return string
     */
    public function getHelpMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaHelpMessage'];
    }

    /**
     * Get the cancel title
     *
     * @return string
     */
    public function getCancelTitle(): string
    {
        return $this->commonTexts[$this->locale]['alexaCancelTitle'];
    }

    /**
     * Get the cancel message
     *
     * @return string
     */
    public function getCancelMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaCancelMessage'];
    }

    /**
     * Get the stop title
     *
     * @return string
     */
    public function getStopTitle(): string
    {
        return $this->commonTexts[$this->locale]['alexaStopTitle'];
    }

    /**
     * Get the stop message
     *
     * @return string
     */
    public function getStopMessage(): string
    {
        return $this->commonTexts[$this->locale]['alexaStopMessage'];
    }
}
