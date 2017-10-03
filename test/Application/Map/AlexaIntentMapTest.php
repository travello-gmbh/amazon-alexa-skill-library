<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Application\Map;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Application\Map\IntentMap;
use TravelloAlexaLibrary\Intent\StopIntent;

/**
 * Class AlexaIntentMapTest
 *
 * @package TravelloAlexaLibraryTest\Application\Map
 */
class AlexaIntentMapTest extends TestCase
{
    /**
     * test class instantiation
     */
    public function testInstantiation()
    {
        $config = [];

        $intentMap = new IntentMap($config);

        $this->assertEquals($config, $intentMap->getMap());
    }

    /**
     * test get stop intent
     */
    public function testGetStopIntent()
    {
        $config = [
            StopIntent::NAME => StopIntent::class,
        ];

        $intentMap = new IntentMap($config);

        $stopIntent = $intentMap->getIntent(StopIntent::NAME);

        $this->assertEquals(StopIntent::class, $stopIntent);
    }
}
