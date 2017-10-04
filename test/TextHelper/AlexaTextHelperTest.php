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

namespace TravelloAlexaLibraryTest\TextHelper;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibraryTest\TextHelper\TestAsset\TestTextHelper;

/**
 * Class AlexaTextHelperTest
 *
 * @package TravelloAlexaLibraryTest\TextHelper
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
    public function testInstantiationWithRandomTexts()
    {
        $texts = [
            'de-DE' => [
                'alexaLaunchTitle'     => [
                    'Launch Titel 1',
                    'Launch Titel 2',
                    'Launch Titel 3',
                ],
                'alexaLaunchMessage'   => [
                    'Launch Nachricht 1',
                    'Launch Nachricht 2',
                    'Launch Nachricht 3',
                ],
                'alexaRepromptMessage' => [
                    'Reprompt Nachricht 1',
                    'Reprompt Nachricht 2',
                    'Reprompt Nachricht 3',
                ],
                'alexaHelpTitle'       => [
                    'Hilfe Titel 1',
                    'Hilfe Titel 2',
                    'Hilfe Titel 3',
                ],
                'alexaHelpMessage'     => [
                    'Hilfe Nachricht 1',
                    'Hilfe Nachricht 2',
                    'Hilfe Nachricht 3',
                ],
                'alexaStopTitle'       => [
                    'Stop Titel 1',
                    'Stop Titel 2',
                    'Stop Titel 3',
                ],
                'alexaStopMessage'     => [
                    'Stop Nachricht 1',
                    'Stop Nachricht 2',
                    'Stop Nachricht 3',
                ],
            ],
        ];

        $textHelper = new TestTextHelper();
        $textHelper->setLocale('de-DE');

        $this->assertTrue(
            in_array($textHelper->getLaunchTitle(), $texts['de-DE']['alexaLaunchTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getLaunchMessage(), $texts['de-DE']['alexaLaunchMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getRepromptMessage(), $texts['de-DE']['alexaRepromptMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getHelpTitle(), $texts['de-DE']['alexaHelpTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getHelpMessage(), $texts['de-DE']['alexaHelpMessage'])
        );

        $this->assertTrue(
            in_array($textHelper->getStopTitle(), $texts['de-DE']['alexaStopTitle'])
        );

        $this->assertTrue(
            in_array($textHelper->getStopMessage(), $texts['de-DE']['alexaStopMessage'])
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
