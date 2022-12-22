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
 * Filter
 */
class Filter
{

    /**
     * P-ISSN
     *
     * @var string
     */
    protected $pIssn;

    /**
     * E-ISSN
     *
     * @var string
     */
    protected $eIssn;

    /**
     * amount
     *
     * @var Price
     */
    protected $price;

    /**
     * financing
     *
     * @var string
     */
    protected $financing;

    /**
     * source
     *
     * @var string
     */
    protected $source;

    /**
     * __construct
     */
    public function __construct($pIssn, $eIssn, $amount, $currency, $financing, $source)
    {
        $this->pIssn = $pIssn;
        $this->eIssn = $eIssn;
        $this->price = Price::fromAmountAndCurrency($amount, $currency);
        $this->financing = $financing;
        $this->source = $source;
    }

    /**
     * Returns the P-ISSN
     *
     * @return string
     */
    public function getPIssn()
    {
        return $this->pIssn;
    }

    /**
     * Returns the E-ISSN
     *
     * @return string
     */
    public function getEIssn()
    {
        return $this->eIssn;
    }

    /**
     * Returns the price
     *
     * @return Price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the financing
     *
     * @return string
     */
    public function getFinancing()
    {
        return $this->financing;
    }

    /**
     * Returns the source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}
