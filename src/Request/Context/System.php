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

namespace TravelloAlexaLibrary\Request\Context;

use TravelloAlexaLibrary\Request\Context\System\ApplicationInterface;
use TravelloAlexaLibrary\Request\Context\System\DeviceInterface;
use TravelloAlexaLibrary\Request\Context\System\UserInterface;

/**
 * Class System
 *
 * @package TravelloAlexaLibrary\Request\Context
 */
class System implements SystemInterface
{
    /** @var ApplicationInterface */
    private $application;

    /** @var UserInterface */
    private $user;

    /** @var DeviceInterface */
    private $device;

    /** @var string */
    private $apiEndpoint;

    /**
     * System constructor.
     *
     * @param ApplicationInterface $application
     * @param UserInterface        $user
     * @param DeviceInterface      $device
     * @param string|null          $apiEndpoint
     */
    public function __construct(
        ApplicationInterface $application,
        UserInterface $user,
        DeviceInterface $device,
        string $apiEndpoint = null
    ) {
        $this->application = $application;
        $this->user        = $user;
        $this->device      = $device;

        if ($apiEndpoint) {
            $this->apiEndpoint = $apiEndpoint;
        }
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface
    {
        return $this->device;
    }

    /**
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }
}
