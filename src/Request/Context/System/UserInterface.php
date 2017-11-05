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
 * Interface UserInterface
 *
 * @package TravelloAlexaLibrary\Request\Context\System
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getUserId(): string;

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken);

    /**
     * @return string|null
     */
    public function getAccessToken();

    /**
     * @param string $consentToken
     */
    public function setConsentToken(string $consentToken);

    /**
     * @return string|null
     */
    public function getConsentToken();
}
