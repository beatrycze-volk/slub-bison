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
 * Subject DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property array<Article> $abstractArticles This holds the articles matching by abstract
 * @property array<Article> $titleArticles This holds the articles matching by title
 * @property array<Article> $referenceArticles This holds the articles matching by reference
 * @property integer $semanticScore This holds the score returned by neural network
 * @property float $value This holds the score
 * @property integer $percentage This holds the score converted to percent
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
     * Empty constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Constructor from the subject JSON
     *
     * @access public
     *
     * @static
     *
     * @param array $subject JSON array
     *
     * @return Subject instance of this class
     */
    public static function fromSubject($subject)
    {
        $instance = new self();
        $instance->code = $subject->code;
        $instance->term = $subject->term;
        return $instance;
    }

    /**
     * Constructor from the code and term
     *
     * @access public
     *
     * @static
     *
     * @param string $code of subject
     * @param string $term of subject
     *
     * @return Subject instance of this class
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

    /**
     * Sets parent subject from LC Classification code
     *
     * @access private
     *
     * @return void
     */
    private function setParentClassification()
    {
        $classification = [
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
        ];
        $code = substr($this->code, 0, 1);
        $this->parent = self::fromCodeAndTerm($code, $classification[$code]);
    }
}
