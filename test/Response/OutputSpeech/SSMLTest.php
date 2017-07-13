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
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class SSMLTest
 *
 * @package TravelloAlexaLibraryTest\Response\OutputSpeech
 */
class SSMLTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithLongValues()
    {
        $outputSpeech = new SSML(
            str_pad('ssml', 7000, 'ssml')
        );

        $expected = [
            'type' => 'SSML',
            'ssml' => '<speak>' . str_pad('ssml', 6000, 'ssml') . '</speak>',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithShortValues()
    {
        $outputSpeech = new SSML('ssml');

        $expected = [
            'type' => 'SSML',
            'ssml' => '<speak>ssml</speak>',
        ];

        $this->assertEquals($expected, $outputSpeech->toArray());
    }
}
