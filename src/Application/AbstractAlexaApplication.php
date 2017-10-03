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

use Psr\Container\ContainerInterface;
use TravelloAlexaLibrary\Application\Helper\TextHelperInterface;
use TravelloAlexaLibrary\Intent\HelpIntent;
use TravelloAlexaLibrary\Intent\IntentInterface;
use TravelloAlexaLibrary\Request\AlexaRequestInterface;
use TravelloAlexaLibrary\Request\Certificate\CertificateValidatorInterface;
use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\IntentRequestType;
use TravelloAlexaLibrary\Response\AlexaResponseInterface;

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

    /** @var ContainerInterface */
    protected $intentManager;

    /** @var TextHelperInterface */
    protected $textHelper;

    /** @var string */
    protected $smallImageUrl;

    /** @var string */
    protected $largeImageUrl;

    /**
     * AbstractAlexaApplication constructor.
     *
     * @param AlexaResponseInterface $alexaResponse
     * @param ContainerInterface     $intentManager
     * @param TextHelperInterface    $textHelper
     */
    public function __construct(
        AlexaResponseInterface $alexaResponse,
        ContainerInterface $intentManager,
        TextHelperInterface $textHelper
    ) {
        $this->alexaResponse = $alexaResponse;
        $this->intentManager = $intentManager;
        $this->textHelper    = $textHelper;
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
     * Reset the session attributes
     */
    abstract protected function resetSessionAttributes();

    /**
     * Initialize the alexa response
     *
     * @return bool
     */
    protected function initResponse(): bool
    {
        $this->alexaResponse->addSessionAttributes(
            $this->getSessionAttributes()
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
        if (get_class($this->alexaRequest->getRequest()) === IntentRequestType::class) {
            /** @var IntentRequestType $intentRequest */
            $intentRequest = $this->alexaRequest->getRequest();

            $intentName = $intentRequest->getIntent()->getName();
        } else {
            $intentName = $this->alexaRequest->getRequest()->getType();
        }

        if ($this->intentManager->has($intentName)) {
            /** @var IntentInterface $intent */
            $intent = $this->intentManager->get($intentName);
        } else {
            /** @var IntentInterface $intent */
            $intent = $this->intentManager->get(HelpIntent::NAME);
        }

        $intent->handle($this->textHelper, $this->smallImageUrl, $this->largeImageUrl);

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
