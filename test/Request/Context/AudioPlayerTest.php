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

namespace TravelloAlexaLibraryTest\Request\Context;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Request\Context\AudioPlayer;

/**
 * Class AudioPlayerTest
 *
 * @package TravelloAlexaLibraryTest\Request\Context
 */
class AudioPlayerTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $audioPlayer = new AudioPlayer('IDLE');

        $expected = 'IDLE';

        $this->assertEquals($expected, $audioPlayer->getPlayerActivity());
    }

    /**
     *
     */
    public function testToken()
    {
        $audioPlayer = new AudioPlayer('IDLE');
        $audioPlayer->setToken('123456');

        $expected = '123456';

        $this->assertEquals($expected, $audioPlayer->getToken());
    }

    /**
     *
     */
    public function testOffsetInMilliseconds()
    {
        $audioPlayer = new AudioPlayer('IDLE');
        $audioPlayer->setOffsetInMilliseconds(1000);

        $expected = 1000;

        $this->assertEquals($expected, $audioPlayer->getOffsetInMilliseconds());
    }
}
