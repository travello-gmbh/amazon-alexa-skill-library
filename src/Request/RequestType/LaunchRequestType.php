<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Request\RequestType;

/**
 * Class LaunchRequestType
 *
 * @package TravelloAlexaLibrary\Request\RequestType
 */
class LaunchRequestType extends AbstractRequestType
{
    /** @var string */
    private $type = 'LaunchRequest';

    /**
     * LaunchRequestType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
