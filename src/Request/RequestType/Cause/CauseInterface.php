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

namespace TravelloAlexaLibrary\Request\RequestType\Cause;

/**
 * Interface CauseInterface
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Cause
 */
interface CauseInterface
{
    /**
     * @return string
     */
    public function getRequestId(): string;
}
