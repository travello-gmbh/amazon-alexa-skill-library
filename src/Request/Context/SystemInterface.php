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
 * Interface System
 *
 * @package TravelloAlexaLibrary\Request\Context
 */
interface SystemInterface
{
    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return DeviceInterface
     */
    public function getDevice(): DeviceInterface;

    /**
     * @return string
     */
    public function getApiEndpoint();
}
