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
 * Change the case of all tag names.
 */
class TagNameCaseProcessor
{
    /** @var int */
    private $case;

    /**
     * @param int $case
     */
    public function __construct($case)
    {
        $this->case = $case;
    }

    /**
     * @param array $entry
     * @return array
     */
    public function __invoke(array $entry)
    {
        return array_change_key_case($entry, $this->case);
    }
}
