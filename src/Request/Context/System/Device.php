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

namespace TravelloAlexaLibrary\Request\Context\System;

/**
 * Class Device
 *
 * @package TravelloAlexaLibrary\Request\Context\System
 */
class Device implements DeviceInterface
{
    /** @var string */
    private $deviceId;

    /** @var array */
    private $supportedInterfaces;

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getDeviceId()
    {
        return $this->deviceId;
    }

    /**
     * @param array $supportedInterfaces
     */
    public function setSupportedInterfaces(array $supportedInterfaces)
    {
        $this->supportedInterfaces = $supportedInterfaces;
    }

    /**
     * @return array|null
     */
    public function getSupportedInterfaces()
    {
        return $this->supportedInterfaces;
    }
}
