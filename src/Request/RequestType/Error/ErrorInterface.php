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
 * Interface Error
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Error
 */
interface ErrorInterface
{
    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return string
     */
    public function getType(): string;
}
