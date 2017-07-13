<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Request\Session;

/**
 * Interface User
 *
 * @package TravelloAlexaLibrary\Request\Session
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getAccessToken(): string;

    /**
     * @return string
     */
    public function getUserId(): string;
}
