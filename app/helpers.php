<?php
use App\RenanBr\BibTexParser\Exception\ProcessorException;

class BibtexTypeFormatter
{
    public function __construct($element) {
        $this->element = $element;

        $this->authorArray = isset($this->element->author) ? $this->extractAuthors($this->element->author->value) : [];
        $this->editorArray = isset($this->element->editor) ? $this->extractAuthors($this->element->editor->value) : [];

        $this->month = $this->fieldExists('month') ?  $this->getElementByAttribute('month') : '';
        $this->year = $this->fieldExists('year') ?  $this->getElementByAttribute('year') : '';
        $this->title = $this->fieldExists('title') ?  $this->getElementByAttribute('month') : '';

        $this->createCompareNamesString();
    }

    public function setShort() {
        $this->short = true;
    }

    public function setLong() {
        $this->short = false;
    }

    public function getElementByAttribute($atr, $separator = '', $before = '') {
        $result = '';
        if($this->fieldExists($atr)) {
            $result = $before . $this->element->$atr->value . $separator;
        }

        return $result;
    }

    public function getType($givenType = '', $separator = '', $before = '') {
        $result = '';
        if(trim($givenType) != '')
        {
            $result = $before . $givenType . $separator;
        }
        elseif($this->fieldExists('type')) {
            $result = $before . $this->element->type->value . $separator;
        }
        else {
            switch($this->element->entrytype->value) {
                case 'phdthesis':
                    $result = $before . 'PhD&nbsp;thesis' . $separator;
                    break;
                case 'masterthesis':
                    $result = $before . 'Master\'s&nbsp;thesis' . $separator;
                    break;
            }
        }
        return $result;
    }

    public function getAuthorOrEditor($separator = '')
    {
        $result = [];
        $textResult = '';

        if ($this->fieldExists('author')) {
            $length = count($this->authorArray);

            for ($i = 0; $i < $length; $i++) {
                $temp = '';
                $person = $this->authorArray[$i];

                if ($length > 1 and $i == $length - 1) { $temp .= 'and '; }

                if ($this->short) { $temp .= $this->getNamesFirstLetters($person['first']) . ' ' .$person['von'] . ' ' .$person['last']; }
                else { $temp .= $person['first'] . ' ' .$person['von'] . ' ' .$person['last']; }

                if ($person['jr'] != '') { $temp .= ', ' . $person['jr']; }

                $result[] = $temp;
            }

            if($length > 2) {
                $textResult = implode(', ', $result);
            } else{
                $textResult = implode(' ', $result);
            }

        } elseif ($this->fieldExists('editor')) {
            $length = count($this->editorArray);

            for ($i = 0; $i < $length; $i++) {
                $temp = '';
                $person = $this->editorArray[$i];

                if ($length > 1 and $i == $length - 1) { $temp .= 'and '; }

                if ($this->short) { $temp .= $this->getNamesFirstLetters($person['first']) . ' ' .$person['von'] . ' ' .$person['last']; }
                else { $temp .= $person['first'] . ' ' .$person['von'] . ' ' .$person['last']; }

                if ($person['jr'] != '') { $temp .= ', ' . $person['jr']; }

                $result[] = $temp;
            }

            if($length > 2) { $textResult = implode(', ', $result); }
            else { $textResult = implode(' ', $result); }

            if($length < 2) { $textResult = $textResult . ',&nbsp;editor'; }
            else { $textResult = $textResult . ',&nbsp;editors'; }
        }

        $finalResult = ($textResult == '') ? '' : $textResult . $separator;

        return $finalResult;
    }

    public function getEditorIfWasntUsedBefore($separator = '') {
        $result = [];
        $textResult = '';

        if ($this->fieldExists('author') and $this->fieldExists('editor')) {
            $length = count($this->editorArray);

            for ($i = 0; $i < $length; $i++) {
                $temp = '';
                $person = $this->editorArray[$i];

                if ($length > 1 and $i == $length - 1) { $temp .= 'and '; }

                if ($this->short) { $temp .= $this->getNamesFirstLetters($person['first']) . ' ' .$person['von'] . ' ' .$person['last']; }
                else { $temp .= $person['first'] . ' ' .$person['von'] . ' ' .$person['last']; }

                if ($person['jr'] != '') { $temp .= ', ' . $person['jr']; }

                $result[] = $temp;
            }

            $textResult = implode(', ', $result);

            if($length < 2) { $textResult = $textResult . ',&nbsp;editor'; }
            else { $textResult = $textResult . ',&nbsp;editors'; }

            $textResult = 'In&nbsp;' . $textResult;
        }

        $finalResult = ($textResult == '') ? '' : $textResult . $separator;

        return $finalResult;
    }

    public function getKey($separator = '') {
        $temp = [];

        if($this->fieldExists('issn'))
        {
            $temp[] = "ISSN&nbsp;" . $this->element->issn->value;
        }

        if($this->fieldExists('isbn'))
        {
            $temp[] = "ISBN&nbsp;" . $this->element->isbn->value;
        }

        if($this->fieldExists('doi'))
        {
            $temp[] = "doi:&nbsp;" . $this->element->doi->value;
        }

        $result = implode(", ", $temp);

        if(!empty($result))
            $result .= $separator;

        return $result;
    }

    public function getDate($separator = '', $before = '')  {
        $result = '';

        if($this->fieldExists('year'))
        {
            if($this->fieldExists('month'))
            {
                $result .= $this->element->month->value . ' ';
            }

            $result .= $this->element->year->value;
        }

        if($result != '') {
            $result = $before . $result . $separator;
        }

        return $result;
    }

    public function setDotAtStringEnd($str) {
        $str = trim($str);
        if(strlen($str) > 0 and ($str[strlen($str)-1] == ',' or $str[strlen($str)-1] == '.'))
        {
            $str[strlen($str)-1] = '.';
        }
        elseif(strlen($str) > 0)
        {
            $str .= '.';
        }

        return $str;
    }

    public function setElement($element) {
        $this->element = $element;
    }

    public function getElement() {
        return $this->element;
    }

    public function fieldExists($fieldName)
    {
        return isset($this->element->$fieldName) and trim($this->element->$fieldName->value) != '';
    }

    private function getNamesFirstLetters($arg) {
        $names = explode(' ', $arg);
        $result = [];
        foreach($names as $name) {
            $result[] = substr($name, 0, 1) . '.';
        }

        return implode(' ', $result);
    }

    private function createCompareNamesString()
    {
        foreach ($this->authorArray as $person)
            $this->compareNamesString .= $person['last'] . $person['von'] . $person['first'] . $person['jr'];

        foreach ($this->editorArray as $person)
            $this->compareNamesString .= $person['last'] . $person['von'] . $person['first'] . $person['jr'];
    }

    private $short = false;

    public $element = [];

    private $authorArray = [];
    private $editorArray = [];
    private $month = '';
    public $year = '';
    public $title = '';

    public $compareNamesString = '';

    // ---------------------------------------------------------------

    /**
     * Extracting the authors
     *
     * @param  string $entry The entry with the authors
     * @return array  the extracted authors
     * @author Elmar Pitschke <elmar.pitschke@gmx.de>
     */
    private function extractAuthors($entry)
    {
        // Sanitizes the entry to remove unwanted whitespace
        $entry = trim(preg_replace('/\s+/', ' ', $entry));

        $authorarray = [];
        $authorarray = explode(' and ', $entry);
        for ($i = 0; $i < count($authorarray); $i++) {
            $author = trim($authorarray[$i]);
            /*The first version of how an author could be written (First von Last)
            has no commas in it*/
            $first = '';
            $von = '';
            $last = '';
            $jr = '';
            if (mb_strpos($author, ',') === false) {
                $tmparray = [];
                $tmparray = preg_split('/[\s\~]/', $author);
                $size = count($tmparray);
                if (1 === $size) { //There is only a last
                    $last = $tmparray[0];
                } elseif (2 === $size) { //There is a first and a last
                    $first = $tmparray[0];
                    $last = $tmparray[1];
                } else {
                    $invon = false;
                    $inlast = false;
                    for ($j = 0; $j < ($size - 1); $j++) {
                        if ($inlast) {
                            $last .= ' '.$tmparray[$j];
                        } elseif ($invon) {
                            try {
                                $case = $this->determineCase($tmparray[$j]);

                                if ((0 === $case) || (-1 === $case)) { //Change from von to last
                                    //You only change when there is no more lower case there
                                    $islast = true;
                                    for ($k = ($j + 1); $k < ($size - 1); $k++) {
                                        try {
                                            $futurecase = $this->determineCase($tmparray[$k]);
                                            if (0 === $futurecase) {
                                                $islast = false;
                                            }
                                        } catch (ProcessorException $sbe) {
                                            // Ignore
                                        }
                                    }
                                    if ($islast) {
                                        $inlast = true;
                                        if (-1 === $case) { //Caseless belongs to the last
                                            $last .= ' '.$tmparray[$j];
                                        } else {
                                            $von .= ' '.$tmparray[$j];
                                        }
                                    } else {
                                        $von .= ' '.$tmparray[$j];
                                    }
                                } else {
                                    $von .= ' '.$tmparray[$j];
                                }
                            } catch (ProcessorException $sbe) {
                                // Ignore
                            }
                        } else {
                            try {
                                $case = $this->determineCase($tmparray[$j]);
                                if (0 === $case) { //Change from first to von
                                    $invon = true;
                                    $von .= ' '.$tmparray[$j];
                                } else {
                                    $first .= ' '.$tmparray[$j];
                                }
                            } catch (ProcessorException $sbe) {
                                // Ignore
                            }
                        }
                    }
                    //The last entry is always the last!
                    $last .= ' '.$tmparray[$size - 1];
                }
            } else { //Version 2 and 3
                $tmparray = [];
                $tmparray = explode(',', $author);
                //The first entry must contain von and last
                $vonlastarray = [];
                $vonlastarray = explode(' ', $tmparray[0]);
                $size = count($vonlastarray);
                if (1 === $size) { //Only one entry->got to be the last
                    $last = $vonlastarray[0];
                } else {
                    $inlast = false;
                    for ($j = 0; $j < ($size - 1); $j++) {
                        if ($inlast) {
                            $last .= ' '.$vonlastarray[$j];
                        } else {
                            if (0 !== ($this->determineCase($vonlastarray[$j]))) { //Change from von to last
                                $islast = true;
                                for ($k = ($j + 1); $k < ($size - 1); $k++) {
                                    try {
                                        $case = $this->determineCase($vonlastarray[$k]);
                                        if (0 === $case) {
                                            $islast = false;
                                        }
                                    } catch (ProcessorException $sbe) {
                                        // Ignore
                                    }
                                }
                                if ($islast) {
                                    $inlast = true;
                                    $last .= ' '.$vonlastarray[$j];
                                } else {
                                    $von .= ' '.$vonlastarray[$j];
                                }
                            } else {
                                $von .= ' '.$vonlastarray[$j];
                            }
                        }
                    }
                    $last .= ' '.$vonlastarray[$size - 1];
                }
                //Now we check if it is version three (three entries in the array (two commas)
                if (3 === count($tmparray)) {
                    $jr = $tmparray[1];
                }
                //Everything in the last entry is first
                $first = $tmparray[count($tmparray) - 1];
            }
            $authorarray[$i] = ['first' => trim($first), 'von' => trim($von), 'last' => trim($last), 'jr' => trim($jr)];
        }

        return $authorarray;
    }

    /**
     * Case Determination according to the needs of BibTex
     *
     * To parse the Author(s) correctly a determination is needed
     * to get the Case of a word. There are three possible values:
     * - Upper Case (return value 1)
     * - Lower Case (return value 0)
     * - Caseless   (return value -1)
     *
     * @param  string         $word
     * @throws ProcessorException
     * @return int            The Case
     * @author Elmar Pitschke <elmar.pitschke@gmx.de>
     */
    private function determineCase($word)
    {
        $ret = -1;
        $trimmedword = trim($word);
        /*We need this variable. Without the next of would not work
        (trim changes the variable automatically to a string!)*/
        if (is_string($word) && (mb_strlen($trimmedword) > 0)) {
            $i = 0;
            $found = false;
            $openbrace = 0;
            while (!$found && ($i <= mb_strlen($word))) {
                $letter = mb_substr($trimmedword, $i, 1);
                $ord = ord($letter);
                if ($ord === 123) { //Open brace
                    $openbrace++;
                }
                if ($ord === 125) { //Closing brace
                    $openbrace--;
                }
                if (($ord >= 65) && ($ord <= 90) && (0 === $openbrace)) { //The first character is uppercase
                    $ret = 1;
                    $found = true;
                } elseif (($ord >= 97) && ($ord <= 122) && (0 === $openbrace)) { //The first character is lowercase
                    $ret = 0;
                    $found = true;
                } else { //Not yet found
                    $i++;
                }
            }
        } else {
            throw new ProcessorException('Could not determine case on word: '.(string) $word);
        }

        return $ret;
    }
}

function compareElements($a, $b)
{
    $compare = strcmp($a->compareNamesString, $b->compareNamesString);

    if($compare == 0)
    {
        $compare = $a->year - $b->year;

        if($compare == 0)
        {
            $compare = strcmp($a->title, $b->title);
        }
    }

    return $compare;
}