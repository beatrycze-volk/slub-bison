<?php

declare(strict_types=1);

namespace Slub\Bison\Domain\Model;


/**
 * This file is part of the "Bison" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Beatrycze Volk <beatrycze.volk@slub-dresden.de>, SLUB
 */

/**
 * DatasetState
 */
class DatasetState extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * dataset
     *
     * @var string
     */
    protected $dataset = null;

    /**
     * date
     *
     * @var \DateTime
     */
    protected $date = null;

    /**
     * Returns the dataset
     *
     * @return string
     */
    public function getDataset()
    {
        return $this->dataset;
    }

    /**
     * Sets the dataset
     *
     * @param string $dataset
     * @return void
     */
    public function setDataset(string $dataset)
    {
        $this->dataset = $dataset;
    }

    /**
     * Returns the date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }
}
