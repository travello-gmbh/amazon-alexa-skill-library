<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Response\OutputSpeech;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Response\OutputSpeech\PlainText;

/**
 * Class PlainTextTest
 *
 * @package TravelloAlexaLibraryTest\Response\OutputSpeech
 */
class PlainTextTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $outputSpeech = new PlainText(
            str_pad('text', 7000, 'text')
        );

        $expected = [
            'type' => 'PlainText',
            'text' => str_pad('text', 6000, 'text'),
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $outputSpeech = new PlainText('text');

        $expected = [
            'type' => 'PlainText',
            'text' => 'text',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }
}
