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
 * Class SkillConfiguration
 *
 * @package TravelloAlexaLibrary\Configuration
 */
class SkillConfiguration implements SkillConfigurationInterface
{
    /** @var string */
    private $name;

    /** @var string */
    private $applicationId;

    /** @var array */
    private $intents = [];

    /** @var array */
    private $texts = [];

    /** @var string */
    private $smallImageUrl;

    /** @var string */
    private $largeImageUrl;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * @param string $applicationId
     */
    public function setApplicationId(string $applicationId)
    {
        $this->applicationId = $applicationId;
    }

    /**
     * @return array
     */
    public function getIntents(): array
    {
        return $this->intents;
    }

    /**
     * @param array $intents
     */
    public function setIntents(array $intents)
    {
        $this->intents = $intents;
    }

    /**
     * @return array
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    /**
     * @param array $texts
     */
    public function setTexts(array $texts)
    {
        $this->texts = $texts;
    }

    /**
     * @return string
     */
    public function getSmallImageUrl(): string
    {
        return $this->smallImageUrl;
    }

    /**
     * @param string $smallImageUrl
     */
    public function setSmallImageUrl(string $smallImageUrl)
    {
        $this->smallImageUrl = $smallImageUrl;
    }

    /**
     * @return string
     */
    public function getLargeImageUrl(): string
    {
        return $this->largeImageUrl;
    }

    /**
     * @param string $largeImageUrl
     */
    public function setLargeImageUrl(string $largeImageUrl)
    {
        $this->largeImageUrl = $largeImageUrl;
    }
}
