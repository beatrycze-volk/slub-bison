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
        $languages = array(
            "AR" => "Arabic",
            "CA" => "Catalan",
            "DE" => "German",
            "EN" => "English",
            "ES" => "Spanish",
            "FA" => "Persian",
            "FR" => "French",
            "ID" => "Indonesian",
            "IT" => "Italian",
            "PL" => "Polish",
            "PT" => "Portuguese",
            "RU" => "Russian",
            "SL" => "Slovenian",
            "TR" => "Turkish"
        );
        
        $this->name = $languages[$this->code];
        if (empty($this->name)) {
            $this->name = 'Unknown';
        }
    }
}
