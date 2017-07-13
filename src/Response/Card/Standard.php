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

namespace TravelloAlexaLibrary\Response\Card;

/**
 * Class Standard
 *
 * @package TravelloAlexaLibrary\Response\Card
 */
class Standard implements CardInterface
{
    /** Maximum length of title attribute */
    const MAX_TITLE_LENGTH = 64;

    /** Maximum length of text attribute */
    const MAX_TEXT_LENGTH = 6000;

    /** @var string */
    private $text;

    /** @var string */
    private $title;

    /** @var string */
    private $smallImageUrl;

    /** @var string */
    private $largeImageUrl;

    /**
     * Standard constructor.
     *
     * @param string $title
     * @param string $text
     * @param string $smallImageUrl
     * @param string $largeImageUrl
     */
    public function __construct($title, $text, $smallImageUrl, $largeImageUrl)
    {
        $this->setTitle($title);
        $this->setText($text);
        $this->setSmallImageUrl($smallImageUrl);
        $this->setLargeImageUrl($largeImageUrl);
    }

    /**
     * Render the card object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type'  => 'Standard',
            'title' => $this->title,
            'text'  => $this->text,
            'image' => [
                'smallImageUrl' => $this->smallImageUrl,
                'largeImageUrl' => $this->largeImageUrl,
            ],
        ];
    }

    /**
     * @param string $title
     */
    private function setTitle($title)
    {
        if (strlen($title) > self::MAX_TITLE_LENGTH) {
            $title = substr($title, 0, self::MAX_TITLE_LENGTH);
        }

        $this->title = $title;
    }

    /**
     * @param string $text
     */
    private function setText($text)
    {
        if (strlen($text) > self::MAX_TEXT_LENGTH) {
            $text = substr($text, 0, self::MAX_TEXT_LENGTH);
        }

        $this->text = $text;
    }

    /**
     * @param string $smallImageUrl
     */
    private function setSmallImageUrl(string $smallImageUrl)
    {
        $this->smallImageUrl = $smallImageUrl;
    }

    /**
     * @param string $largeImageUrl
     */
    private function setLargeImageUrl(string $largeImageUrl)
    {
        $this->largeImageUrl = $largeImageUrl;
    }
}
