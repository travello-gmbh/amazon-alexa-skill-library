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

namespace TravelloAlexaLibrary\Response\Directives;

/**
 * Interface DirectivesInterface
 *
 * @package TravelloAlexaLibrary\Response\Directives
 */
interface DirectivesInterface
{
    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array;
}
