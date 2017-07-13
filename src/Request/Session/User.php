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

namespace TravelloAlexaLibrary\Request\Session;

/**
 * Class User
 *
 * @package TravelloAlexaLibrary\Request\Session
 */
class User implements UserInterface
{
    /** @var string */
    private $accessToken;

    /** @var string */
    private $userId;

    /**
     * User constructor.
     *
     * @param string $userId
     * @param string $accessToken
     */
    public function __construct(string $userId, string $accessToken = null)
    {
        $this->userId      = $userId;
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}
