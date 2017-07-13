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

namespace TravelloAlexaLibrary\Request\RequestType\Error;

/**
 * Class Error
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Error
 */
class Error implements ErrorInterface
{
    /** @var string */
    private $message;

    /** @var string */
    private $type;

    /**
     * Error constructor.
     *
     * @param string $type
     * @param string $message
     */
    public function __construct(string $type, string $message)
    {
        $this->type    = $type;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
