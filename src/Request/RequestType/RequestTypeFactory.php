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

namespace TravelloAlexaLibrary\Request\RequestType;

use TravelloAlexaLibrary\Request\AlexaRequest;
use TravelloAlexaLibrary\Request\Context\AudioPlayer;
use TravelloAlexaLibrary\Request\Context\Context;
use TravelloAlexaLibrary\Request\Context\System;
use TravelloAlexaLibrary\Request\Context\System\Application as ContextApplication;
use TravelloAlexaLibrary\Request\Context\System\Device;
use TravelloAlexaLibrary\Request\Context\System\User as ContextUser;
use TravelloAlexaLibrary\Request\RequestType\AudioPlayer\CurrentPlaybackState;
use TravelloAlexaLibrary\Request\RequestType\Error\Error;
use TravelloAlexaLibrary\Request\RequestType\Intent\Intent;
use TravelloAlexaLibrary\Request\Session\Application as SessionApplication;
use TravelloAlexaLibrary\Request\Session\Session;
use TravelloAlexaLibrary\Request\Session\User as SessionUser;

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

        $version = $data['version'] ?? AlexaRequest::DEFAULT_VERSION;

        $session = new Session(
            $data['session']['new'],
            $data['session']['sessionId'],
            new SessionApplication($data['session']['application']['applicationId']),
            $data['session']['attributes'] ?? [],
            new SessionUser($data['session']['user']['userId'])
        );

        if (isset($data['context'])) {
            $audioPlayer = new AudioPlayer(
                $data['context']['AudioPlayer']['playerActivity']
            );

            if (isset($data['context']['AudioPlayer']['token'])) {
                $audioPlayer->setToken($data['context']['AudioPlayer']['token']);
            }

            if (isset($data['context']['AudioPlayer']['offsetInMilliseconds'])) {
                $audioPlayer->setOffsetInMilliseconds($data['context']['AudioPlayer']['offsetInMilliseconds']);
            }

            $context = new Context($audioPlayer);

            if (isset($data['context']['System'])) {
                $contextUser = new ContextUser($data['context']['System']['user']['userId']);

                if (isset($data['context']['System']['user']['accessToken'])) {
                    $contextUser->setAccessToken($data['context']['System']['user']['accessToken']);
                }

                if (isset($data['context']['System']['user']['permissions'])
                    && isset($data['context']['System']['user']['permissions']['consentToken'])) {
                    $contextUser->setConsentToken($data['context']['System']['user']['permissions']['consentToken']);
                }

                $device = new Device($data['context']['System']['device']['deviceId']);

                if (isset($data['context']['System']['device']['supportedInterfaces'])) {
                    $device->setSupportedInterfaces($data['context']['System']['device']['supportedInterfaces']);
                }

                $system = new System(
                    new ContextApplication($data['context']['System']['application']['applicationId']),
                    $contextUser,
                    $device,
                    $data['context']['System']['apiEndpoint']
                );

                $context->setSystem($system);
            }
        } else {
            $context = null;
        }

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

            case 'AudioPlayer.PlaybackStarted':
                $request = new AudioPlayerPlaybackStartedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackStopped':
                $request = new AudioPlayerPlaybackStoppedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackFinished':
                $request = new AudioPlayerPlaybackFinishedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackNearlyFinished':
                $request = new AudioPlayerPlaybackNearlyFinishedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $data['request']['offsetInMilliseconds']
                );

                break;

            case 'AudioPlayer.PlaybackFailed':
                if (isset($data['request']['error'])) {
                    $error = new Error(
                        $data['request']['error']['type'],
                        $data['request']['error']['message']
                    );
                } else {
                    $error = null;
                }

                if (isset($data['request']['currentPlaybackState'])) {
                    $currentPlaybackState = new CurrentPlaybackState(
                        $data['request']['currentPlaybackState']['playerActivity'],
                        $data['request']['currentPlaybackState']['offsetInMilliseconds'],
                        $data['request']['currentPlaybackState']['token']
                    );
                } else {
                    $currentPlaybackState = null;
                }

                $request = new AudioPlayerPlaybackFailedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale'],
                    $data['request']['token'],
                    $error,
                    $currentPlaybackState
                );

                break;

            case 'PlaybackController.NextCommandIssued':
                $request = new PlaybackControllerNextCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PauseCommandIssued':
                $request = new PlaybackControllerPauseCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PlayCommandIssued':
                $request = new PlaybackControllerPlayCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
                );
                break;

            case 'PlaybackController.PreviousCommandIssued':
                $request = new PlaybackControllerPreviousCommandIssuedType(
                    $data['request']['requestId'],
                    $data['request']['timestamp'],
                    $data['request']['locale']
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

        return new AlexaRequest($version, $session, $request, $context, $rawRequestData);
    }
}
