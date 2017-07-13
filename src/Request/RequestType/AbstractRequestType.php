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
 * Class AbstractRequestType
 *
 * @package TravelloAlexaLibrary\Request\Request
 */
abstract class AbstractRequestType implements RequestTypeInterface
{
    /** @var string */
    protected $locale;

    /** @var string */
    protected $requestId;

    /** @var string */
    protected $timestamp;

    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }
}
