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
        return $this->getText('alexaLaunchTitle');
    }

    /**
     * Get the launch message
     *
     * @return string
     */
    public function getLaunchMessage(): string
    {
        return $this->getText('alexaLaunchMessage');
    }

    /**
     * Get the reprompt message
     *
     * @return string
     */
    public function getRepromptMessage(): string
    {
        return $this->getText('alexaRepromptMessage');
    }

    /**
     * Get the help title
     *
     * @return string
     */
    public function getHelpTitle(): string
    {
        return $this->getText('alexaHelpTitle');
    }

    /**
     * Get the help message
     *
     * @return string
     */
    public function getHelpMessage(): string
    {
        return $this->getText('alexaHelpMessage');
    }

    /**
     * Get the cancel title
     *
     * @return string
     */
    public function getCancelTitle(): string
    {
        return $this->getText('alexaCancelTitle');
    }

    /**
     * Get the cancel message
     *
     * @return string
     */
    public function getCancelMessage(): string
    {
        return $this->getText('alexaCancelMessage');
    }

    /**
     * Get the stop title
     *
     * @return string
     */
    public function getStopTitle(): string
    {
        return $this->getText('alexaStopTitle');
    }

    /**
     * Get the stop message
     *
     * @return string
     */
    public function getStopMessage(): string
    {
        return $this->getText('alexaStopMessage');
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    protected function getText($type)
    {
        if (is_string($this->commonTexts[$this->locale][$type])) {
            return $this->commonTexts[$this->locale][$type];
        }

        $randomKey = array_rand($this->commonTexts[$this->locale][$type]);

        return $this->commonTexts[$this->locale][$type][$randomKey];
    }
}
