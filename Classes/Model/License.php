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
 * License DTO
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $code This holds the code of language in ISO 639
 * @property string $name This holds the name of language in English
 */
class License
{

    /**
     * non-commercial
     *
     * @var boolean
     */
    protected $nonCommercial;

    /**
     * no derivative
     *
     * @var boolean
     */
    protected $noDerivative;

    /**
     * attribution
     *
     * @var boolean
     */
    protected $attribution;

    /**
     * share alike
     *
     * @var boolean
     */
    protected $shareAlike;

    /**
     * type
     *
     * @var string
     */
    protected $type;

    /**
     * Constructs license instance
     *
     * @access public
     *
     * @param array $license The JSON array containing license information
     *
     * @return void
     */
    public function __construct($license)
    {
        $this->nonCommercial = $license->nc;
        $this->noDerivative = $license->nd;
        $this->attribution = $license->by;
        $this->shareAlike = $license->sa;
        $this->type = $license->typex;
    }

    /**
     * Returns the information about non-commercial attribute of CC license
     *
     * @return bool
     */
    public function getNonCommercial()
    {
        return $this->nonCommercial;
    }

    /**
     * Returns the information about no derivative attribute of CC license
     *
     * @return bool
     */
    public function getNoDerivative()
    {
        return $this->noDerivative;
    }

    /**
     * Returns the information about attribution attribute of CC license
     *
     * @return bool
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * Returns the information about share alike attribute of CC license
     *
     * @return bool
     */
    public function getShareAlike()
    {
        return $this->shareAlike;
    }

    /**
     * Returns the license type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
