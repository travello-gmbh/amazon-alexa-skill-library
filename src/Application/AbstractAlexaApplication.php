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

namespace TravelloAlexaLibrary\Application;

use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Request\AlexaRequestInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\AlexaResponseInterface;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class AbstractAlexaApplication
 *
 * @package TravelloAlexaLibrary\Application
 */
abstract class AbstractAlexaApplication implements AlexaApplicationInterface
{
    const BREAK_OUTPUT = '<break time="1s"/>';
    const BREAK_CARD = "\n \n";

    /** @var AlexaRequestInterface */
    protected $alexaRequest;

    /** @var AlexaResponseInterface */
    protected $alexaResponse;

    /** @var string */
    protected $applicationId;

    /** @var CertificateValidatorInterface */
    protected $certificateValidator;

    /** @var TextHelperInterface */
    protected $textHelper;

    /** @var string */
    protected $smallImageUrl;

    /** @var string */
    protected $largeImageUrl;

    /**
     * AbstractAlexaApplication constructor.
     *
     * @param TextHelperInterface $textHelper
     */
    public function __construct(TextHelperInterface $textHelper)
    {
        $this->textHelper = $textHelper;
    }

    /**
     * @param AlexaRequestInterface $alexaRequest
     */
    public function setAlexaRequest(AlexaRequestInterface $alexaRequest)
    {
        $this->alexaRequest = $alexaRequest;
    }

    /**
     * @param CertificateValidatorInterface $certificateValidator
     */
    public function setCertificateValidator(
        CertificateValidatorInterface $certificateValidator
    ) {
        $this->certificateValidator = $certificateValidator;
    }

    /**
     * Execute the application
     *
     * @return array
     * @throws BadRequest
     */
    public function execute(): array
    {
        $this->checkRequest();
        $this->setLocale();
        $this->initSessionAttributes();
        $this->initResponse();
        $this->handleRequest();

        return $this->returnResponse();
    }

    /**
     * @throws BadRequest
     */
    protected function checkRequest()
    {
        $this->alexaRequest->checkApplication($this->getApplicationId());
        $this->certificateValidator->validate();
    }

    /**
     * Get the application id
     *
     * @return string
     */
    protected function getApplicationId(): string
    {
        return $this->applicationId;
    }

    /**
     * Set the locale
     */
    protected function setLocale()
    {
        $this->textHelper->setLocale($this->alexaRequest->getRequest()->getLocale());
    }

    /**
     * Initialize the session attributes
     *
     * @return bool
     */
    abstract protected function initSessionAttributes(): bool;

    /**
     * Get the session attributes
     *
     * @return array
     */
    abstract protected function getSessionAttributes(): array;

    /**
     * Initialize the alexa response
     *
     * @return bool
     */
    protected function initResponse(): bool
    {
        $this->alexaResponse = new AlexaResponse();
        $this->alexaResponse->addSessionAttributes(
            $this->getSessionAttributes()
        );
        $this->alexaResponse->setReprompt(
            new SSML($this->textHelper->getRepromptMessage())
        );

        return true;
    }

    /**
     * Handle the request for all request types
     *
     * @return bool
     */
    protected function handleRequest(): bool
    {
        switch ($this->alexaRequest->getRequest()->getType()) {
            case 'LaunchRequest':
                return $this->launchIntent();

            case 'IntentRequest':
                return $this->handleIntentRequest();

            case 'SessionEndedRequest':
            default:
                return $this->stopIntent();
        }
    }

    /**
     * Handle custom application intents
     *
     * @return bool
     */
    abstract protected function handleIntentRequest(): bool;

    /**
     * Handle the help intent
     *
     * @return bool
     */
    protected function helpIntent(): bool
    {
        $this->alexaResponse->setOutputSpeech(
            new SSML($this->textHelper->getHelpMessage())
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getHelpTitle(),
                $this->textHelper->getHelpMessage(),
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        return true;
    }

    /**
     * Handle the launch intent
     *
     * @return bool
     */
    protected function launchIntent(): bool
    {
        $this->alexaResponse->setOutputSpeech(
            new SSML($this->textHelper->getLaunchMessage())
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getLaunchTitle(),
                $this->textHelper->getLaunchMessage(),
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        return true;
    }

    /**
     * Handle the cancel intent
     *
     * @return bool
     */
    protected function cancelIntent(): bool
    {
        $this->alexaResponse->setOutputSpeech(
            new SSML($this->textHelper->getCancelMessage())
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getCancelTitle(),
                $this->textHelper->getCancelMessage(),
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        $this->alexaResponse->endSession();

        return true;
    }

    /**
     * Handle the stop intent
     *
     * @return bool
     */
    protected function stopIntent(): bool
    {
        $this->alexaResponse->setOutputSpeech(
            new SSML($this->textHelper->getStopMessage())
        );

        $this->alexaResponse->setCard(
            new Standard(
                $this->textHelper->getStopTitle(),
                $this->textHelper->getStopMessage(),
                $this->smallImageUrl,
                $this->largeImageUrl
            )
        );

        $this->alexaResponse->endSession();

        return true;
    }

    /**
     * Return the rendered alexa response
     *
     * @return array
     */
    protected function returnResponse(): array
    {
        return $this->alexaResponse->toArray();
    }
}
