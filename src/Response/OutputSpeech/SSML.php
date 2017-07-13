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

namespace TravelloAlexaLibrary\Response\OutputSpeech;

/**
 * Class SSML
 *
 * @package TravelloAlexaLibrary\Response\OutputSpeech
 */
class SSML implements OutputSpeechInterface
{
    /** Maximum length of ssml attribute */
    const MAX_SSML_LENGTH = 6000;

    /** @var string */
    private $ssml;

    /**
     * SSML constructor.
     *
     * @param string $ssml
     */
    public function __construct(string $ssml)
    {
        $this->setSsml($ssml);
    }

    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'SSML',
            'ssml' => $this->ssml,
        ];
    }

    /**
     * @param string $ssml
     */
    private function setSsml(string $ssml)
    {
        if (strlen($ssml) > self::MAX_SSML_LENGTH) {
            $ssml = substr($ssml, 0, self::MAX_SSML_LENGTH);
        }

        $this->ssml = '<speak>' . $ssml . '</speak>';
    }
}
