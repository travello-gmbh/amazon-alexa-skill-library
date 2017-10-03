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

namespace TravelloAlexaLibrary\Application\Map;

/**
 * Class IntentMap
 *
 * @package TravelloAlexaLibrary\Application\Map
 */
class IntentMap
{
    /** @var array */
    private $config = [];

    /**
     * IntentMap constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return $this->config;
    }

    /**
     * @param string $name
     *
     * @return string
     */
    public function getIntent(string $name) : string
    {
        if (isset($this->config[$name])) {
            return $this->config[$name];
        }
    }
}
