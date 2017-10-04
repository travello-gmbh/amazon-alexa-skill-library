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

namespace TravelloAlexaLibraryTest\Request\Session;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\Session\User;

/**
 * Class UserTest
 *
 * @package TravelloAlexaLibraryTest\Request\Session
 */
class UserTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithAccessToken()
    {
        $user = new User('userId', 'accessToken');

        $expected = 'accessToken';

        $this->assertEquals($expected, $user->getAccessToken());
    }

    /**
     *
     */
    public function testInstantiationWithUserId()
    {
        $user = new User('userId');

        $expected = 'userId';

        $this->assertEquals($expected, $user->getUserId());
    }
}
