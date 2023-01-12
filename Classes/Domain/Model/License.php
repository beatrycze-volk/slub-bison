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
 * License
 */
class License extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * nonCommercial
     *
     * @var boolean
     */
    protected $nonCommercial = null;

    /**
     * noDerivative
     *
     * @var boolean
     */
    protected $noDerivative = null;

    /**
     * attribution
     *
     * @var boolean
     */
    protected $attribution = null;

    /**
     * Returns the nonCommercial
     *
     * @return bool
     */
    public function getNonCommercial()
    {
        return $this->nonCommercial;
    }

    /**
     * Sets the nonCommercial
     *
     * @param bool $nonCommercial
     * @return void
     */
    public function setNonCommercial(bool $nonCommercial)
    {
        $this->nonCommercial = $nonCommercial;
    }

    /**
     * Returns the boolean state of nonCommercial
     *
     * @return bool
     */
    public function isNonCommercial()
    {
        return $this->nonCommercial;
    }

    /**
     * Returns the noDerivative
     *
     * @return bool
     */
    public function getNoDerivative()
    {
        return $this->noDerivative;
    }

    /**
     * Sets the noDerivative
     *
     * @param bool $noDerivative
     * @return void
     */
    public function setNoDerivative(bool $noDerivative)
    {
        $this->noDerivative = $noDerivative;
    }

    /**
     * Returns the boolean state of noDerivative
     *
     * @return bool
     */
    public function isNoDerivative()
    {
        return $this->noDerivative;
    }

    /**
     * Returns the attribution
     *
     * @return bool
     */
    public function getAttribution()
    {
        return $this->attribution;
    }

    /**
     * Sets the attribution
     *
     * @param bool $attribution
     * @return void
     */
    public function setAttribution(bool $attribution)
    {
        $this->attribution = $attribution;
    }

    /**
     * Returns the boolean state of attribution
     *
     * @return bool
     */
    public function isAttribution()
    {
        return $this->attribution;
    }
}
