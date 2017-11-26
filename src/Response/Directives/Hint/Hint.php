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

namespace TravelloAlexaLibrary\Response\Directives\Hint;

use TravelloAlexaLibrary\Response\Directives\DirectivesInterface;

/**
 * Class Hint
 *
 * @package TravelloAlexaLibrary\Response\Directives\Hint
 */
class Hint implements DirectivesInterface
{
    /** Type of directive */
    const DIRECTIVE_TYPE = 'Hint';

    /** @var string */
    private $text;

    /**
     * Hint constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * Get the directive type
     *
     * @return string
     */
    public function getType(): string
    {
        return self::DIRECTIVE_TYPE;
    }

    /**
     * Render the directives object to an array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'type' => self::DIRECTIVE_TYPE,
            'hint' => [
                'type' => 'PlainText',
                'text' => $this->text,
            ],
        ];
    }
}
