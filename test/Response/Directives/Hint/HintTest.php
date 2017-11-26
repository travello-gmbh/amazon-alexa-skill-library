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

namespace TravelloAlexaLibraryTest\Response\Directives\Hint;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Response\Directives\Hint\Hint;

/**
 * Class HintTest
 *
 * @package TravelloAlexaLibraryTest\Response\Directives\Hint;
 */
class HintTest extends TestCase
{
    /**
     *
     */
    public function testWithMandatoryOnly()
    {
        $hint = new Hint('this is a text');

        $expected = [
            'type' => 'Hint',
            'hint' => [
                'type' => 'PlainText',
                'text' => 'this is a text',
            ],
        ];

        $this->assertEquals($expected, $hint->toArray());
    }
}
