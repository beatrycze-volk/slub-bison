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
 * Language DTO
 */
class Language
{
    /**
     * code
     *
     * @var string
     */
    protected $code;

    /**
     * name
     *
     * @var string
     */
    protected $name;


    /**
     * __construct
     */
    public function __construct($lang)
    {
        $this->code = $lang;
        $this->convertCodeToName();
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
     * Returns the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Convert ISO 639 code to the language name
     */
    private function convertCodeToName() {
        //TODO: use here translated names of languages
        switch ($this->code) {
            case 'AR':
                $this->name = 'Arabic';
                break;
            case 'CA':
                $this->name = 'Catalan';
                break;
            case 'EN':
                $this->name = 'English';
                break;
            case 'ES':
                $this->name = 'Spanish';
                break;
            case 'FA':
                $this->name = 'Persian';
                break;
            case 'FR':
                $this->name = 'French';
                break;
            case 'ID':
                $this->name = 'Indonesian';
                break;
            case 'IT':
                $this->name = 'Italian';
                break;
            case 'PL':
                $this->name = 'Polish';
                break;
            case 'PT':
                $this->name = 'Portuguese';
                break;
            case 'RU':
                $this->name = 'Russian';
                break;
            case 'SL':
                $this->name = 'Slovenian';
                break;
            case 'TR':
                $this->name = 'Turkish';
                break;
            default:
                $this->name = 'Unknown';
        }
    }
}
