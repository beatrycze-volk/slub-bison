<?php

declare(strict_types=1);

namespace Slub\Bison\Result;


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
 */
class Score
{
    /**
     * articles
     *
     * @var array<Article>
     */
    protected $articles = [];

    /**
     * semantic score
     *
     * @var int
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
     * @var int
     */
    protected $percentage;

    /**
     * __construct
     */
    public function __construct($score)
    {
        foreach ($score->title as $title) {
            $this->articles[] = new Article($title, 'title');
        }
        foreach ($score->abstract as $abstract) {
            $this->articles[] = new Article($abstract, 'abstract');
        }
        foreach ($score->dois as $doi) {
            $this->articles[] = new Article($doi, 'doi');
        }
        $this->semanticScore = $score->semantic_score;
        $this->value = $score->value;
        $this->percentage = intval($score->value * 100);
    }

    /**
     * Returns the articles
     *
     * @return array<Article>
     */
    public function getArticles()
    {
        return $this->articles;
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
