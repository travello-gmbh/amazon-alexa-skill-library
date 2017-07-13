<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Request\Session;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\Session\Application;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User;

/**
 * Class SessionTest
 *
 * @package TravelloAlexaLibraryTest\Request\Session
 */
class SessionTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');
        $attributes  = ['foo' => 'bar'];
        $user        = new User('userId', 'accessToken');

        $session = new Session(
            true,
            'sessionId',
            $application,
            $attributes,
            $user
        );

        $this->assertEquals(true, $session->isNew());
        $this->assertEquals('sessionId', $session->getSessionId());
        $this->assertEquals($application, $session->getApplication());
        $this->assertEquals($attributes, $session->getAttributes());
        $this->assertEquals($attributes['foo'], $session->getAttribute('foo'));
        $this->assertEquals(null, $session->getAttribute('bar'));
        $this->assertEquals($user, $session->getUser());
    }
}
