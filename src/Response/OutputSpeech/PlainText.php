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
 * Class PlainText
 *
 * @package TravelloAlexaLibrary\Response\OutputSpeech
 */
class PlainText implements OutputSpeechInterface
{
    /** Maximum length of text attribute */
    const MAX_TEXT_LENGTH = 6000;

    /** @var string */
    private $text;

    /**
     * PlainText constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->setText($text);
    }

    /**
     * Render the output speech object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => 'PlainText',
            'text' => $this->text,
        ];
    }

    /**
     * @param string $text
     */
    private function setText(string $text)
    {
        if (strlen($text) > self::MAX_TEXT_LENGTH) {
            $text = substr($text, 0, self::MAX_TEXT_LENGTH);
        }

        $this->text = $text;
    }
}
