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
