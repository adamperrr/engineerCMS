<?php

/*
 * This file is part of the BibTex Parser.
 *
 * (c) Renan de Lima Barbosa <renandelima@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\RenanBr\BibTexParser\Processor;

/**
 * Splits tags contents as array.
 */
class KeywordsProcessor
{
    use TagCoverageTrait;

    public function __construct()
    {
        $this->setTagCoverage(['keywords']);
    }

    /**
     * @param array $entry
     * @return array
     */
    public function __invoke(array $entry)
    {
        $covered = $this->getCoveredTags(array_keys($entry));
        foreach ($covered as $tag) {
            $entry[$tag] = preg_split('/, |; /', $entry[$tag]);
        }

        return $entry;
    }
}
