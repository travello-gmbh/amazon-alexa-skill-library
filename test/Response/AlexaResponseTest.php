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

namespace TravelloAlexaLibraryTest\Response;

use PHPUnit\Framework\TestCase;
use TravelloAlexaLibrary\Response\AlexaResponse;
use TravelloAlexaLibrary\Response\Card\Simple;
use TravelloAlexaLibrary\Response\Card\Standard;
use TravelloAlexaLibrary\Response\OutputSpeech\PlainText;
use TravelloAlexaLibrary\Response\OutputSpeech\SSML;

/**
 * Class AlexaResponseTest
 *
 * @package TravelloAlexaLibraryTest\Response
 */
class AlexaResponseTest extends TestCase
{
    /**
     *
     */
    public function testInstantiationWithAddingSessionVariables()
    {

        $alexaResponse = new AlexaResponse();
        $alexaResponse->addSessionAttribute('foo', 'bar');
        $alexaResponse->addSessionAttributes(['bar' => 'foo']);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithAll()
    {
        $plainText = new PlainText('text');
        $simple    = new Simple('title', 'content');
        $reprompt  = new PlainText('text');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($plainText);
        $alexaResponse->setCard($simple);
        $alexaResponse->setReprompt($reprompt);
        $alexaResponse->endSession();
        $alexaResponse->addSessionAttributes(
            [
                'foo' => 'bar',
                'bar' => 'foo',
            ]
        );

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'PlainText',
                    'text' => 'text',
                ],
                'card'             => [
                    'type'    => 'Simple',
                    'title'   => 'title',
                    'content' => 'content',
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'PlainText',
                        'text' => 'text',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithSSMLAndStandardCard()
    {
        $ssml     = new SSML('ssml');
        $standard = new Standard('title', 'text', 'https://image.server/small.png', 'https://image.server/large.png');
        $reprompt = new SSML('ssml');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($ssml);
        $alexaResponse->setCard($standard);
        $alexaResponse->setReprompt($reprompt);
        $alexaResponse->endSession();
        $alexaResponse->addSessionAttributes(
            [
                'foo' => 'bar',
                'bar' => 'foo',
            ]
        );

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => 'bar',
                'bar' => 'foo',
            ],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>ssml</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'title',
                    'text'  => 'text',
                    'image' => [
                        'smallImageUrl' => 'https://image.server/small.png',
                        'largeImageUrl' => 'https://image.server/large.png',
                    ],
                ],
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'SSML',
                        'ssml' => '<speak>ssml</speak>',
                    ],
                ],
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithAppendingSessionVariables()
    {

        $alexaResponse = new AlexaResponse();
        $alexaResponse->addSessionAttribute('foo', 'bar');
        $alexaResponse->appendSessionAttribute('foo', 'bar');

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'foo' => [
                    'bar',
                    'bar',
                ],
            ],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithCard()
    {
        $simple = new Simple('title', 'content');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setCard($simple);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'card'             => [
                    'type'    => 'Simple',
                    'title'   => 'title',
                    'content' => 'content',
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithEndSession()
    {
        $alexaResponse = new AlexaResponse();
        $alexaResponse->endSession();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => true,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithNoValues()
    {
        $alexaResponse = new AlexaResponse();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithOutputSpeech()
    {
        $plainText = new PlainText('text');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setOutputSpeech($plainText);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'PlainText',
                    'text' => 'text',
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithRemovingSessionVariables()
    {

        $alexaResponse = new AlexaResponse();
        $alexaResponse->addSessionAttributes(
            [
                'foo' => 'bar',
                'bar' => 'foo',
            ]
        );
        $alexaResponse->removeSessionAttribute('foo');

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [
                'bar' => 'foo',
            ],
            'response'          => [
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     *
     */
    public function testInstantiationWithReprompt()
    {
        $reprompt = new PlainText('text');

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setReprompt($reprompt);

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'reprompt'         => [
                    'outputSpeech' => [
                        'type' => 'PlainText',
                        'text' => 'text',
                    ],
                ],
                'shouldEndSession' => false,
            ],
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
