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

namespace TravelloAlexaLibrary\Configuration;

/**
 * Interface SkillConfiguration
 *
 * @package TravelloAlexaLibrary\Configuration
 */
interface SkillConfigurationInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getApplicationId(): string;

    /**
     * @param string $applicationId
     */
    public function setApplicationId(string $applicationId);

    /**
     * @return array
     */
    public function getIntents(): array;

    /**
     * @param array $intents
     */
    public function setIntents(array $intents);

    /**
     * @return string
     */
    public function getSmallImageUrl(): string;

    /**
     * @param string $smallImageUrl
     */
    public function setSmallImageUrl(string $smallImageUrl);

    /**
     * @return string
     */
    public function getLargeImageUrl(): string;

    /**
     * @param string $largeImageUrl
     */
    public function setLargeImageUrl(string $largeImageUrl);
}
