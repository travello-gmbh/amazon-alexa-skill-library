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

namespace Request\Exception;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use TravelloAlexaLibrary\Request\Exception\BadRequest;

/**
 * Class BadRequestExceptionTest
 *
 * @package Request\Exception
 */
class BadRequestExceptionTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $exception = new BadRequest('This was a bad request');

        $this->assertTrue($exception instanceof RuntimeException);
    }
}
