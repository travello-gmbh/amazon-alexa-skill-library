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

namespace TravelloAlexaLibrary\Request\RequestType\Intent;

/**
 * Class Intent
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Intent
 */
class Intent implements IntentInterface
{
    /** @var string */
    private $name;

    /** @var array */
    private $slots = [];

    /**
     * Intent constructor.
     *
     * @param string $name
     * @param array  $slots
     */
    public function __construct(string $name, array $slots = [])
    {
        $this->name  = $name;
        $this->slots = $slots;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function getSlotValue(string $key): string
    {
        if (isset($this->slots[$key]) && isset($this->slots[$key]['value'])) {
            return $this->slots[$key]['value'];
        }

        return '';
    }
}
