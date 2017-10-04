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

namespace TravelloAlexaLibraryTest\Application\TestAsset;

use TravelloAlexaLibrary\Application\AbstractAlexaApplication;

/**
 * Class TestApplication
 *
 * @package TravelloAlexaLibraryTest\Application\TestAsset
 */
class TestApplication extends AbstractAlexaApplication
{
    /** @var string */
    protected $applicationId = 'amzn1.ask.skill.applicationId';

    /** @var string */
    protected $smallImageUrl = 'https://image.server/small.png';

    /** @var string */
    protected $largeImageUrl = 'https://image.server/large.png';

    /**
     * @return bool
     */
    protected function initSessionAttributes(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    protected function getSessionAttributes(): array
    {
        return ['foo' => 'bar'];
    }

    /**
     * Reset the session attributes
     */
    protected function resetSessionAttributes()
    {
    }
}
