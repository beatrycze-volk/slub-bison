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
    protected $articles;

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
        $this->semanticScore = $score->semanticScore;
        $this->value = $score->value;
        $this->percentage = intval($score->value * 100);
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
