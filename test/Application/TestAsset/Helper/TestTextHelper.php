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
            'alexaLaunchTitle'     => 'launch title',
            'alexaLaunchMessage'   => 'launch message',
            'alexaRepromptMessage' => 'reprompt message',
            'alexaHelpTitle'       => 'help title',
            'alexaHelpMessage'     => 'help message',
            'alexaStopTitle'       => 'stop title',
            'alexaStopMessage'     => 'stop message',
        ];
}
