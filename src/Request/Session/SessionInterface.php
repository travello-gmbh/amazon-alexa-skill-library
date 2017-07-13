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
 * Interface SessionInterface
 *
 * @package TravelloAlexaLibrary\Request\Session
 */
interface SessionInterface
{
    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface;

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @return string
     */
    public function getSessionId(): string;

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface;

    /**
     * @return boolean
     */
    public function isNew(): bool;
}
