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
use TravelloAlexaLibrary\Request\Context\System;
use TravelloAlexaLibrary\Request\Context\System\Application;
use TravelloAlexaLibrary\Request\Context\System\Device;
use TravelloAlexaLibrary\Request\Context\System\User;

/**
 * Class SystemTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context
 */
class SystemTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');
        $user        = new User('userId');
        $device      = new Device('deviceId');
        $apiEndpoint = 'apiEndpoint';

        $system = new System($application, $user, $device, $apiEndpoint);

        $this->assertEquals($application, $system->getApplication());
        $this->assertEquals($user, $system->getUser());
        $this->assertEquals($device, $system->getDevice());
        $this->assertEquals($apiEndpoint, $system->getApiEndpoint());
    }
}
