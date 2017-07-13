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
use TravelloAlexaLibrary\Response\Card\Simple;

/**
 * Class SimpleTest
 *
 * @package TravelloAlexaLibraryTest\Response\Card
 */
class SimpleTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $card = new Simple(
            str_pad('title', 70, 'title'),
            str_pad('content', 7000, 'content')
        );

        $expected = [
            'type'    => 'Simple',
            'title'   => str_pad('title', 64, 'title'),
            'content' => str_pad('content', 6000, 'content'),
        ];

        $this->assertEquals($expected, $card->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $card = new Simple('title', 'content');

        $expected = [
            'type'    => 'Simple',
            'title'   => 'title',
            'content' => 'content',
        ];

        $this->assertEquals($expected, $card->toArray());
    }
}
