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

namespace TravelloAlexaLibraryTest\Response\Card;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Response\Card\Standard;

/**
 * Class StandardTest
 *
 * @package TravelloAlexaLibraryTest\Response\Card
 */
class StandardTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $card = new Standard(
            str_pad('title', 70, 'title'),
            str_pad('text', 7000, 'text'),
            'https://image.server/small.png',
            'https://image.server/large.png'
        );

        $expected = [
            'type'  => 'Standard',
            'title' => str_pad('title', 64, 'title'),
            'text'  => str_pad('text', 6000, 'text'),
            'image' => [
                'smallImageUrl' => 'https://image.server/small.png',
                'largeImageUrl' => 'https://image.server/large.png',
            ],
        ];

        $this->assertEquals($expected, $card->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $card = new Standard('title', 'text', 'https://image.server/small.png', 'https://image.server/large.png');

        $expected = [
            'type'  => 'Standard',
            'title' => 'title',
            'text'  => 'text',
            'image' => [
                'smallImageUrl' => 'https://image.server/small.png',
                'largeImageUrl' => 'https://image.server/large.png',
            ],
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
