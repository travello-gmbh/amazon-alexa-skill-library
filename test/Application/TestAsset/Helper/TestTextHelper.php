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

namespace TravelloAlexaLibraryTest\Application\TestAsset\Helper;

use TravelloAlexaLibrary\Application\Helper\AbstractTextHelper;

/**
 * Class TestTextHelper
 *
 * @package TravelloAlexaLibraryTest\Application\TestAsset\Helper
 */
class TestTextHelper extends AbstractTextHelper
{
    /**
     * @var array
     */
    protected $commonTexts
        = [
            'en-US' => [
                'alexaLaunchTitle'     => 'launch title',
                'alexaLaunchMessage'   => 'launch message',
                'alexaRepromptMessage' => 'reprompt message',
                'alexaHelpTitle'       => 'help title',
                'alexaHelpMessage'     => 'help message',
                'alexaStopTitle'       => 'stop title',
                'alexaStopMessage'     => 'stop message',
                'alexaCancelTitle'     => 'cancel title',
                'alexaCancelMessage'   => 'cancel message',
            ],
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
                'alexaCancelTitle'       => [
                    'Cancel Titel 1',
                    'Cancel Titel 2',
                    'Cancel Titel 3',
                ],
                'alexaCancelMessage'     => [
                    'Cancel Nachricht 1',
                    'Cancel Nachricht 2',
                    'Cancel Nachricht 3',
                ],
            ],
        ];
}
