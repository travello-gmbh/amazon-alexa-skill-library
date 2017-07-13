<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibraryTest\Application\TestAsset;

use TravelloAlexaLibrary\Application\AbstractAlexaApplication;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

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
     * @return bool
     */
    protected function handleIntentRequest(): bool
    {
        /** @var IntentRequestType $intentRequest */
        $intentRequest = $this->alexaRequest->getRequest();

        switch ($intentRequest->getIntent()->getName()) {
            case 'AMAZON.StopIntent':
                return $this->stopIntent();
            // no break

            case 'AMAZON.HelpIntent':
                return $this->helpIntent();
            // no break

            default:
                $this->alexaResponse->setOutputSpeech(
                    new SSML('foo text')
                );

                $this->alexaResponse->setCard(
                    new Standard(
                        'foo title',
                        'foo text',
                        'https://image.server/small.png',
                        'https://image.server/large.png'
                    )
                );
        }

        return true;
    }
}
