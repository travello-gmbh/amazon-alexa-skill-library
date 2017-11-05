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

namespace TravelloAlexaLibraryTest\Request\Context;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\Context\AudioPlayer;
use TravelloAlexaLibrary\Request\Context\Context;
use TravelloAlexaLibrary\Request\Context\System;
use TravelloAlexaLibrary\Request\Context\System\Application;
use TravelloAlexaLibrary\Request\Context\System\Device;
use TravelloAlexaLibrary\Request\Context\System\User;

/**
 * Class ContextTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context
 */
class ContextTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $audioPlayer = new AudioPlayer('IDLE');

        $context = new Context($audioPlayer);

        $this->assertEquals($audioPlayer, $context->getAudioPlayer());
        $this->assertNull($context->getSystem());
    }

    /**
     *
     */
    public function testWithSystem()
    {
        $audioPlayer = new AudioPlayer('IDLE');

        $application = new Application('applicationId');
        $user        = new User('userId');
        $device      = new Device('deviceId');
        $apiEndpoint = 'apiEndpoint';

        $system = new System($application, $user, $device, $apiEndpoint);

        $context = new Context($audioPlayer);
        $context->setSystem($system);

        $this->assertEquals($system, $context->getSystem());
    }
}
