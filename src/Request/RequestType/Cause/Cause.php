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
 * Class Cause
 *
 * @package TravelloAlexaLibrary\Request\RequestType\Cause
 */
class Cause implements CauseInterface
{
    /** @var string */
    private $requestId;

    /**
     * Cause constructor.
     *
     * @param string $requestId
     */
    public function __construct(string $requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }
}
