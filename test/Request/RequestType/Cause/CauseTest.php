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

namespace TravelloAlexaLibraryTest\Request\RequestType\Cause;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\RequestType\Cause\Cause;

/**
 * Class CauseTest
 *
 * @package TravelloAlexaLibraryTest\Request\Session
 */
class CauseTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $cause = new Cause('requestId');

        $this->assertEquals('requestId', $cause->getRequestId());
    }
}
