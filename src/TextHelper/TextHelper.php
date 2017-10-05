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

namespace TravelloAlexaLibrary\TextHelper;

/**
 * Abstract class TextHelper
 *
 * @package TravelloAlexaLibrary\TextHelper
 *
 * @method string getHelpMessage()
 * @method string getHelpTitle()
 * @method string getLaunchMessage()
 * @method string getLaunchTitle()
 * @method string getRepromptMessage()
 * @method string getCancelMessage()
 * @method string getCancelTitle()
 * @method string getStopMessage()
 * @method string getStopTitle()
 */
class TextHelper implements TextHelperInterface
{
    /** @var string */
    protected $locale = 'en-US';

    /** @var array */
    protected $commonTexts
        = [
            'launchTitle'     => '',
            'launchMessage'   => '',
            'repromptMessage' => '',
            'helpTitle'       => '',
            'helpMessage'     => '',
            'cancelTitle'     => '',
            'cancelMessage'   => '',
            'stopTitle'       => '',
            'stopMessage'     => '',
        ];

    /**
     * TextHelper constructor.
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
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $type = lcfirst(str_replace('get', '', $name));

        return $this->getText($type);
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    protected function getText($type)
    {
        if (!isset($this->commonTexts[$this->locale][$type])) {
            return $type;
        }

        if (is_string($this->commonTexts[$this->locale][$type])) {
            return $this->commonTexts[$this->locale][$type];
        }

        $randomKey = array_rand($this->commonTexts[$this->locale][$type]);

        return $this->commonTexts[$this->locale][$type][$randomKey];
    }
}
