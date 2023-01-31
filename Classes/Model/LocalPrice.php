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
 * Local Price DTO - this holds the local prices read
 * from the CSV file.
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $pIssn This holds the P-ISSN of the journal
 * @property string $eIssn This holds the E-ISSN of the journal
 * @property Price $price This holds the local price information
 * @property string $financing This holds the information about financing
 * @property string $source This holds the source of the price information
 */
class LocalPrice
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
     * Constructor for local filter condition read from the CSV file
     *
     * @access public
     *
     * @param string $pIssn the P-ISSN of the journal
     * @param string $eIssn the E-ISSN of the journal
     * @param string $amount the amount of publication charge for the journal
     * @param string $currency the currency of publication charge for the journal
     * @param string $financing the source of the price information
     * @param string $source the source of the price information
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
     * Returns the P-ISSN of the journal
     *
     * @return string
     */
    public function getPIssn()
    {
        return $this->pIssn;
    }

    /**
     * Returns the E-ISSN of the journal
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
     * Returns the source of the price information
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }
}
