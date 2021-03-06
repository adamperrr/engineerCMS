<?php

/*
 * This file is part of the BibTex Parser.
 *
 * (c) Renan de Lima Barbosa <renandelima@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\RenanBr\BibTexParser;

class Listener implements ListenerInterface
{
    /** @var array */
    private $entries = [];

    /**
     * Current tag name.
     *
     * Indicates where to save contents when triggered by the parser.
     *
     * @var string
     */
    private $currentTagName;

    /** @var array */
    private $processors = [];

    /** @var bool */
    private $processed = false;

    /**
     * @return array All entries found during parsing process.
     */
    public function export()
    {
        if (!$this->processed) {
            foreach ($this->processors as $processor) {
                $this->entries = array_filter(array_map($processor, $this->entries));
            }
            $this->processed = true;
        }

        return $this->entries;
    }

    /**
     * @param callable $processor Function to be applied to every BibTeX entry.
     *                            The processor given must return the modified entry.
     *                            Processors will be applied in the same order in which they were added.
     *                            The suggested signature is:
     *                                function (array $entry): array
     */
    public function addProcessor(callable $processor)
    {
        $this->processors[] = $processor;
    }

    public function bibTexUnitFound($text, $type, array $context)
    {
        switch ($type) {
            case Parser::TYPE:
                // Starts a new entry
                $this->entries[] = ['entrytype' => $text];
                break;

            case Parser::CITATION_KEY:
                $index = count($this->entries) - 1;
                $this->entries[$index]['citation-key'] = $text;
                break;

            case PARSER::TAG_NAME:
                // Saves tag into the current entry
                $index = count($this->entries) - 1;
                $this->currentTagName = $text;
                $this->entries[$index][$this->currentTagName] = null;
                break;

            case PARSER::RAW_TAG_CONTENT:
                // Searchs for an abbreviation
                foreach ($this->entries as $entry) {
                    if ('string' === $entry['entrytype'] && array_key_exists($text, $entry)) {
                        $text = $entry[$text];
                        break;
                    }
                }
                // no break

            case PARSER::BRACED_TAG_CONTENT:
            case PARSER::QUOTED_TAG_CONTENT:
                // Appends content into the current tag
                if (null !== $text) {
                    $index = count($this->entries) - 1;
                    $this->entries[$index][$this->currentTagName] .= $text;
                }
                break;

            case Parser::ENTRY:
                $index = count($this->entries) - 1;
                // $this->entries[$index]['_original'] = $text;
                break;
        }
    }
}
