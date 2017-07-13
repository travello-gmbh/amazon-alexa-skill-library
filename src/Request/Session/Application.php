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
 * Class Application
 *
 * @package TravelloAlexaLibrary\Request\Session
 */
class Application implements ApplicationInterface
{
    /** @var string */
    private $applicationId;

    /**
     * Application constructor.
     *
     * @param string $applicationId
     */
    public function __construct(string $applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }
}
