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

/**
 * Class ApplicationTest
 *
 * @package TravelloAlexaLibraryTest\Request\Session
 */
class ApplicationTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $application = new Application('applicationId');

        $expected = 'applicationId';

        $this->assertEquals($expected, $application->getApplicationId());
    }
}
