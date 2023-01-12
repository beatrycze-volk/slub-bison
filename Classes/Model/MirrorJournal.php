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
 * Mirror Journal DTO
 */
class MirrorJournal
{

    /**
     * ISSN
     *
     * @var string
     */
    protected $issn;

    /**
     * ISSN of the original journal
     *
     * @var string
     */
    protected $originalIssn;

    /**
     * title
     *
     * @var string
     */
    protected $title;

    /**
     * publisher
     *
     * @var Publisher
     */
    protected $publisher;

    /**
     * access data
     *
     * @var AccessData
     */
    protected $accessData;

    /**
     * discontinued year
     *
     * @var integer
     */
    protected $discontinuedYear;

    /**
     * last updated
     *
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * Construct mirror journal instance
     * 
     * @access public
     * 
     * @param string $issn: The ISSN of mirror journal
     * @param string $originalIssn: The ISSN of original journal
     * @param string $title: The title of mirror journal
     * @param string $publisher: The publisher of mirror journal
     * @param string $url: The URL of mirror journal
     * @param int $discontinuedYear: The year in which mirror journal was discontinued
     * @param \DateTime $lastUpdated: The date in which mirror journal was last updated
     * 
     * @return void
     */
    public function __construct($issn, $originalIssn, $title, $publisher, $url, $discontinuedYear, $lastUpdated)
    {
        $this->issn = $issn;
        $this->originalIssn = $originalIssn;
        $this->title = $title;
        $this->publisher = new Publisher($publisher, '');
        $this->accessData = AccessData::fromUrl($url);
        $this->discontinuedYear = $discontinuedYear;
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * Returns the ISSN
     *
     * @return string
     */
    public function getIssn()
    {
        return $this->issn;
    }

    /**
     * Returns the original journal ISSN
     *
     * @return string
     */
    public function getOriginalIssn()
    {
        return $this->originalIssn;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the publisher
     *
     * @return Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Returns the access data
     *
     * @return AccessData
     */
    public function getAccessData()
    {
        return $this->accessData;
    }

    /**
     * Year in which journal was discontinued
     *
     * @return int
     */
    public function getDiscontinuedYear()
    {
        return $this->discontinuedYear;
    }

    /**
     * Date of last update
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
