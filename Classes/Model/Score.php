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
 * Score DTO
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
class Score
{

    /**
     * abstract articles
     *
     * @var array<Article>
     */
    protected $abstractArticles = [];

    /**
     * title articles
     *
     * @var array<Article>
     */
    protected $titleArticles = [];

    /**
     * reference articles
     *
     * @var array<Article>
     */
    protected $referenceArticles = [];

    /**
     * semantic score
     *
     * @var integer
     */
    protected $semanticScore;

    /**
     * value
     *
     * @var float
     */
    protected $value;

    /**
     * percentage
     *
     * @var integer
     */
    protected $percentage;

    /**
     * Constructs score instance
     *
     * @param array $score the score JSON array
     *
     * @return void
     */
    public function __construct($score)
    {
        foreach ($score->title as $title) {
            $this->titleArticles[] = new Article($title);
        }

        foreach ($score->abstract as $abstract) {
            $this->abstractArticles[] = new Article($abstract);
        }

        foreach ($score->dois as $doi) {
            $this->referenceArticles[] = new Article($doi);
        }

        $this->semanticScore = $score->semantic_score;
        $this->value = $score->value;
        $this->percentage = round($score->value * 100);
    }

    /**
     * Returns the abstract articles
     *
     * @return array<Article>
     */
    public function getAbstractArticles()
    {
        return $this->abstractArticles;
    }

    /**
     * Returns the title articles
     *
     * @return array<Article>
     */
    public function getTitleArticles()
    {
        return $this->titleArticles;
    }

    /**
     * Returns the reference articles
     *
     * @return array<Article>
     */
    public function getReferenceArticles()
    {
        return $this->referenceArticles;
    }

    /**
     * Returns the semantic score
     *
     * @return int
     */
    public function getSemanticScore()
    {
        return $this->semanticScore;
    }

    /**
     * Returns the value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the percentage
     *
     * @return int
     */
    public function getPercentage()
    {
        return $this->percentage;
    }
}
