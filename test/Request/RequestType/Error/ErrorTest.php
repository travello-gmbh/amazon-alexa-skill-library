<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Request\RequestType\Error;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\Error\Error;

/**
 * Class ErrorTest
 *
 * @package TravelloAlexaLibraryTest\Request\Session
 */
class ErrorTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $error = new Error('type', 'message');

        $this->assertEquals('type', $error->getType());
        $this->assertEquals('message', $error->getMessage());
    }
}
