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
use TravelloAlexaLibrary\Request\Context\System\Application;

/**
 * Class ApplicationTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context\System
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
