<?php

declare(strict_types=1);

namespace Slub\Bison\Model;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * Journal DTO
 */
class Subject
{

    /**
     * term
     *
     * @var string
     */
    protected $term;

    /**
     * code
     *
     * @var string
     */
    protected $code;

    /**
     * parent subject
     *
     * @var Subject
     */
    protected $parent;

    /**
     * __construct
     */
    public function __construct()
    {
    }

    /**
     * __construct
     */
    public static function fromSubject($subject)
    {
        $instance = new self();
        $instance->code = $subject->code;
        $instance->term = $subject->term;
        return $instance;
    }

    /**
     * __construct
     */
    public static function fromCodeAndTerm($code, $term)
    {
        $instance = new self();
        $instance->code = $code;
        $instance->term = $term;
        return $instance;
    }

    /**
     * Returns the term
     *
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Returns the code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the parent
     *
     * @return string
     */
    public function getParent()
    {
        $this->setParentClassification();
        return $this->parent;
    }

    private function setParentClassification() {
        $classification = array(
            "A" => "General Works",
            "B" => "Philosophy, Psychology and Religion",
            "C" => "Auxiliary Sciences of History",
            "D" => "History of Europe, Asia, Africa and Oceania",
            "E" => "History of the United States",
            "F" => "Local History of the United States, Canada and Latin America",
            "G" => "Geography, Anthropology and Recreation",
            "H" => "Social sciences",
            "J" => "Political Science",
            "K" => "Law",
            "L" => "Education",
            "M" => "Music",
            "N" => "Fine Arts",
            "P" => "Language and Literature",
            "Q" => "Science",
            "R" => "Medicine",
            "S" => "Agriculture",
            "T" => "Technology",
            "U" => "Military Science",
            "V" => "Naval Science",
            "Z" => "Bibliography, Library Science and Information Resources"
        );
        $code = substr($this->code, 0, 1);
        $this->parent = self::fromCodeAndTerm($code, $classification[$code]);
    }
}
