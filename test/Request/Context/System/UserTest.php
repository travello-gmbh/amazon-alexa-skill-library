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

namespace TravelloAlexaLibraryTest\Request\Context\System;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\Context\System\User;

/**
 * Class UserTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context\System
 */
class UserTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $user = new User('userId');

        $expected = 'userId';

        $this->assertEquals($expected, $user->getUserId());
        $this->assertNull($user->getAccessToken());
        $this->assertNull($user->getConsentToken());
    }

    /**
     *
     */
    public function testAccessToken()
    {
        $user = new User('userId');
        $user->setAccessToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $user->getAccessToken());
    }

    /**
     *
     */
    public function testConsentToken()
    {
        $user = new User('userId');
        $user->setConsentToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $user->getConsentToken());
    }
}
