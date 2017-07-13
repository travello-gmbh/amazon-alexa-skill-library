<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Request;

use TravelloAlexaLibrary\Request\Exception\BadRequest;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeInterface;
use TravelloAlexaLibrary\Request\Session\SessionInterface;

/**
 * Class AlexaRequest
 *
 * @package TravelloAlexaLibrary\Request
 */
class AlexaRequest implements AlexaRequestInterface
{
    const NAME = 'AlexaRequest';

    /** @todo not implemented yet */
    private $context;

    /** @var string */
    private $rawRequestData;

    /** @var RequestTypeInterface */
    private $request;

    /** @var SessionInterface */
    private $session;

    /** @var string */
    private $version = '1.0';

    /**
     * AlexaRequest constructor.
     *
     * @param string               $version
     * @param SessionInterface     $session
     * @param RequestTypeInterface $request
     * @param string               $rawRequestData
     */
    public function __construct(
        string $version,
        SessionInterface $session,
        RequestTypeInterface $request,
        string $rawRequestData
    ) {
        $this->version        = $version;
        $this->session        = $session;
        $this->request        = $request;
        $this->rawRequestData = $rawRequestData;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    /**
     * @return RequestTypeInterface
     */
    public function getRequest(): RequestTypeInterface
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getRawRequestData(): string
    {
        return $this->rawRequestData;
    }

    /**
     * @param string $applicationId
     *
     * @throws BadRequest
     */
    public function checkApplication(string $applicationId)
    {
        if ($this->getSession()->getApplication()->getApplicationId()
            != $applicationId
        ) {
            throw new BadRequest('Application Id invalid');
        }
    }
}