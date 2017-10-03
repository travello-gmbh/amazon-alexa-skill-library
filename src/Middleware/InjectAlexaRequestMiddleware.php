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

namespace TravelloAlexaLibrary\Middleware;

use Fig\Http\Message\RequestMethodInterface;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\RequestTypeFactory;

/**
 * Class InjectAlexaRequestMiddleware
 *
 * @package TravelloAlexaLibrary\Middleware
 */
class InjectAlexaRequestMiddleware implements ServerMiddlewareInterface
{
    /** @var bool */
    private $logFlag = false;

    /**
     * InjectAlexaRequestMiddleware constructor.
     *
     * @param bool $logFlag
     */
    public function __construct(bool $logFlag = false)
    {
        $this->logFlag = $logFlag;
    }

    /**
     * @param Request           $request
     * @param DelegateInterface $delegate
     *
     * @return mixed
     */
    public function process(Request $request, DelegateInterface $delegate)
    {
        if ($request->getMethod() == RequestMethodInterface::METHOD_POST
            && $request->getHeaderLine('signaturecertchainurl')
        ) {
            if ($this->logFlag) {
                $microtime = explode('.', microtime(true));

                $random = date('Y-m-d-H-i-s-') . $microtime[1];

                file_put_contents(
                    PROJECT_ROOT . '/data/last-request-' . $random . '.json',
                    $request->getBody()->getContents()
                );

                file_put_contents(
                    PROJECT_ROOT . '/data/last-headers-' . $random . '.json',
                    json_encode($request->getHeaders(), JSON_PRETTY_PRINT)
                );
            }

            $alexaRequest = RequestTypeFactory::createFromData(
                $request->getBody()->getContents()
            );

            $request = $request->withAttribute(
                AlexaRequest::NAME,
                $alexaRequest
            );
        }

        return $delegate->process($request);
    }
}
