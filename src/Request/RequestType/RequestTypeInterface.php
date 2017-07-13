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
 * Interface AbstractRequestType
 *
 * @package TravelloAlexaLibrary\Request\Request
 */
interface RequestTypeInterface
{
    /**
     * @return string
     */
    public function getLocale(): string;

    /**
     * @return string
     */
    public function getRequestId(): string;

    /**
     * @return string
     */
    public function getTimestamp(): string;

    /**
     * @return string
     */
    public function getType(): string;
}
