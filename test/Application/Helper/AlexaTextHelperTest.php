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
            'en-US' => [
                'alexaLaunchTitle'     => 'another launch title',
                'alexaLaunchMessage'   => 'another launch message',
                'alexaRepromptMessage' => 'another reprompt message',
                'alexaHelpTitle'       => 'another help title',
                'alexaHelpMessage'     => 'another help message',
                'alexaStopTitle'       => 'another stop title',
                'alexaStopMessage'     => 'another stop message',
            ],
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
    public function testInstantiationWithGermanLocale()
    {
        $texts = [
            'en-US' => [
                'alexaLaunchTitle'     => 'another launch title',
                'alexaLaunchMessage'   => 'another launch message',
                'alexaRepromptMessage' => 'another reprompt message',
                'alexaHelpTitle'       => 'another help title',
                'alexaHelpMessage'     => 'another help message',
                'alexaStopTitle'       => 'another stop title',
                'alexaStopMessage'     => 'another stop message',
            ],
            'de-DE' => [
                'alexaLaunchTitle'     => 'deutscher Launch Titel',
                'alexaLaunchMessage'   => 'deutsche Launch Nachricht',
                'alexaRepromptMessage' => 'deutsche Reprompt Nachricht',
                'alexaHelpTitle'       => 'deutscher Hilfe Titel',
                'alexaHelpMessage'     => 'deutsche Hilfe Nachricht',
                'alexaStopTitle'       => 'deutscher Stop Titel',
                'alexaStopMessage'     => 'deutsche Stop Nachricht',
            ],
        ];

        $textHelper = new TestTextHelper($texts);
        $textHelper->setLocale('de-DE');

        $this->assertEquals(
            'deutscher Launch Titel',
            $textHelper->getLaunchTitle()
        );
        $this->assertEquals(
            'deutsche Launch Nachricht',
            $textHelper->getLaunchMessage()
        );
        $this->assertEquals(
            'deutsche Reprompt Nachricht',
            $textHelper->getRepromptMessage()
        );
        $this->assertEquals(
            'deutscher Hilfe Titel',
            $textHelper->getHelpTitle()
        );
        $this->assertEquals(
            'deutsche Hilfe Nachricht',
            $textHelper->getHelpMessage()
        );
        $this->assertEquals(
            'deutscher Stop Titel',
            $textHelper->getStopTitle()
        );
        $this->assertEquals(
            'deutsche Stop Nachricht',
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
