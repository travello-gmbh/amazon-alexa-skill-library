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
use TravelloAlexaLibrary\Request\Context\Display;

/**
 * Class DisplayTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context
 */
class DisplayTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $display = new Display();

        $this->assertNull($display->getTemplateVersion());
        $this->assertNull($display->getMarkupVersion());
        $this->assertNull($display->getToken());
    }

    /**
     *
     */
    public function testToken()
    {
        $display = new Display();
        $display->setToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $display->getToken());
    }

    /**
     *
     */
    public function testTemplateVersion()
    {
        $display = new Display();
        $display->setTemplateVersion('1.0');

        $expected = '1.0';

        $this->assertEquals($expected, $display->getTemplateVersion());
    }

    /**
     *
     */
    public function testMarkupVersion()
    {
        $display = new Display();
        $display->setMarkupVersion('1.0');

        $expected = '1.0';

        $this->assertEquals($expected, $display->getMarkupVersion());
    }
}
