<?php
/**
 * PHP Library for Amazon Alexa Skills
 *
 * @author     Ralf Eggert <ralf@travello.de>
 * @link       https://github.com/travello-gmbh/amazon-alexa-skill-library
 * @link       https://www.travello.de/
 *
 */

namespace TravelloAlexaLibrary\Request\RequestType;

use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\RequestType\Error\Error;
use TravelloAlexaLibrary\Request\RequestType\Intent\Intent;
use TravelloAlexaLibrary\Request\Session\Application;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User;

/**
 * Class RequestTypeFactory
 *
 * @package TravelloAlexaLibrary\Request\RequestType
 */
class RequestTypeFactory
{
    /**
     * @param string $data
     *
     * @return AlexaRequest
     */
    public static function createFromData(string $data): AlexaRequest
    {
        $rawRequestData = $data;

        $data = json_decode($data, true);

        $version = $data['version'];

        $session = new Session(
            $data['session']['new'],
            $data['session']['sessionId'],
            new Application($data['session']['application']['applicationId']),
            $data['session']['attributes'] ?? [],
            new User($data['session']['user']['userId'])
        );

        switch ($data['request']['type']) {
            case 'LaunchRequest':
                $request = new LaunchRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'SessionEndedRequest':
                if (isset($data['request']['error'])) {
                    $error = new Error(
                        $data['request']['error']['type'],
                        $data['request']['error']['message']
                    );
                } else {
                    $error = null;
                }

                $request = new SessionEndedRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['reason'],
                    $error
                );

                break;

            case 'IntentRequest':
            default:
                $intent = new Intent(
                    $data['request']['intent']['name'],
                    $data['request']['intent']['slots'] ?? []
                );

                $request = new IntentRequestType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $intent
                );
                break;
        }

        return new AlexaRequest($version, $session, $request, $rawRequestData);
    }
}
