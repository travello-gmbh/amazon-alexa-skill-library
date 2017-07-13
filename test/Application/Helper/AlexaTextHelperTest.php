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

namespace TravelloAlexaLibraryTest\Application\Helper;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibraryTest\Application\TestAsset\Helper\TestTextHelper;

/**
 * Class AlexaTextHelperTest
 *
 * @package TravelloAlexaLibraryTest\Application\Helper
 */
class AlexaTextHelperTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithTexts()
    {
        $texts = [
            'alexaLaunchTitle'     => 'another launch title',
            'alexaLaunchMessage'   => 'another launch message',
            'alexaRepromptMessage' => 'another reprompt message',
            'alexaHelpTitle'       => 'another help title',
            'alexaHelpMessage'     => 'another help message',
            'alexaStopTitle'       => 'another stop title',
            'alexaStopMessage'     => 'another stop message',
        ];

        $textHelper = new TestTextHelper($texts);

        $this->assertEquals(
            'another launch title',
            $textHelper->getLaunchTitle()
        );
        $this->assertEquals(
            'another launch message',
            $textHelper->getLaunchMessage()
        );
        $this->assertEquals(
            'another reprompt message',
            $textHelper->getRepromptMessage()
        );
        $this->assertEquals(
            'another help title',
            $textHelper->getHelpTitle()
        );
        $this->assertEquals(
            'another help message',
            $textHelper->getHelpMessage()
        );
        $this->assertEquals(
            'another stop title',
            $textHelper->getStopTitle()
        );
        $this->assertEquals(
            'another stop message',
            $textHelper->getStopMessage()
        );
    }

    /**
     *
     */
    public function testInstantiationWithoutTexts()
    {
        $textHelper = new TestTextHelper();

        $this->assertEquals('launch title', $textHelper->getLaunchTitle());
        $this->assertEquals('launch message', $textHelper->getLaunchMessage());
        $this->assertEquals(
            'reprompt message',
            $textHelper->getRepromptMessage()
        );
        $this->assertEquals('help title', $textHelper->getHelpTitle());
        $this->assertEquals('help message', $textHelper->getHelpMessage());
        $this->assertEquals('stop title', $textHelper->getStopTitle());
        $this->assertEquals('stop message', $textHelper->getStopMessage());
    }
}
