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
 *
 * @author Beatrycze Volk <beatrycze.volk@slub-dresden.de>
 * @package TYPO3
 * @subpackage bison
 * @access public
 * @property string $code This holds the code of language in ISO 639
 * @property string $name This holds the name of language in English
 */
class Language
{

    /**
     * code ISO 639
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
     * Constructs language instance
     *
     * @access public
     *
     * @param array $languageCode The code of language in ISO 639
     *
     * @return void
     */
    public function __construct($languageCode)
    {
        $this->code = $languageCode;
        $this->convertCodeToName();
    }

    /**
     * Returns the code ISO 639
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
     *
     * @access private
     *
     * @return void
     */
    private function convertCodeToName()
    {
        $languages = array(
            'aa' => 'Afar',
            'ab' => 'Abkhaz',
            'ae' => 'Avestan',
            'af' => 'Afrikaans',
            'ak' => 'Akan',
            'am' => 'Amharic',
            'an' => 'Aragonese',
            'ar' => 'Arabic',
            'as' => 'Assamese',
            'av' => 'Avaric',
            'ay' => 'Aymara',
            'az' => 'Azerbaijani',
            'ba' => 'Bashkir',
            'be' => 'Belarusian',
            'bg' => 'Bulgarian',
            'bh' => 'Bihari',
            'bi' => 'Bislama',
            'bm' => 'Bambara',
            'bn' => 'Bengali',
            'bo' => 'Tibetan Standard, Tibetan, Central',
            'br' => 'Breton',
            'bs' => 'Bosnian',
            'ca' => 'Catalan; Valencian',
            'ce' => 'Chechen',
            'ch' => 'Chamorro',
            'co' => 'Corsican',
            'cr' => 'Cree',
            'cs' => 'Czech',
            'cu' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
            'cv' => 'Chuvash',
            'cy' => 'Welsh',
            'da' => 'Danish',
            'de' => 'German',
            'dv' => 'Divehi; Dhivehi; Maldivian;',
            'dz' => 'Dzongkha',
            'ee' => 'Ewe',
            'el' => 'Greek, Modern',
            'en' => 'English',
            'eo' => 'Esperanto',
            'es' => 'Spanish; Castilian',
            'et' => 'Estonian',
            'eu' => 'Basque',
            'fa' => 'Persian',
            'ff' => 'Fula; Fulah; Pulaar; Pular',
            'fi' => 'Finnish',
            'fj' => 'Fijian',
            'fo' => 'Faroese',
            'fr' => 'French',
            'fy' => 'Western Frisian',
            'ga' => 'Irish',
            'gd' => 'Scottish Gaelic; Gaelic',
            'gl' => 'Galician',
            'gn' => 'GuaranÃƒÂ­',
            'gu' => 'Gujarati',
            'gv' => 'Manx',
            'ha' => 'Hausa',
            'he' => 'Hebrew (modern)',
            'hi' => 'Hindi',
            'ho' => 'Hiri Motu',
            'hr' => 'Croatian',
            'ht' => 'Haitian; Haitian Creole',
            'hu' => 'Hungarian',
            'hy' => 'Armenian',
            'hz' => 'Herero',
            'ia' => 'Interlingua',
            'id' => 'Indonesian',
            'ie' => 'Interlingue',
            'ig' => 'Igbo',
            'ii' => 'Nuosu',
            'ik' => 'Inupiaq',
            'io' => 'Ido',
            'is' => 'Icelandic',
            'it' => 'Italian',
            'iu' => 'Inuktitut',
            'ja' => 'Japanese (ja)',
            'jv' => 'Javanese (jv)',
            'ka' => 'Georgian',
            'kg' => 'Kongo',
            'ki' => 'Kikuyu, Gikuyu',
            'kj' => 'Kwanyama, Kuanyama',
            'kk' => 'Kazakh',
            'kl' => 'Kalaallisut, Greenlandic',
            'km' => 'Khmer',
            'kn' => 'Kannada',
            'ko' => 'Korean',
            'kr' => 'Kanuri',
            'ks' => 'Kashmiri',
            'ku' => 'Kurdish',
            'kv' => 'Komi',
            'kw' => 'Cornish',
            'ky' => 'Kirghiz, Kyrgyz',
            'la' => 'Latin',
            'lb' => 'Luxembourgish, Letzeburgesch',
            'lg' => 'Luganda',
            'li' => 'Limburgish, Limburgan, Limburger',
            'ln' => 'Lingala',
            'lo' => 'Lao',
            'lt' => 'Lithuanian',
            'lu' => 'Luba-Katanga',
            'lv' => 'Latvian',
            'mg' => 'Malagasy',
            'mh' => 'Marshallese',
            'mi' => 'Maori',
            'mk' => 'Macedonian',
            'ml' => 'Malayalam',
            'mn' => 'Mongolian',
            'mr' => 'Marathi (Mara?hi)',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'my' => 'Burmese',
            'na' => 'Nauru',
            'nb' => 'Norwegian BokmÃƒÂ¥l',
            'nd' => 'North Ndebele',
            'ne' => 'Nepali',
            'ng' => 'Ndonga',
            'nl' => 'Dutch',
            'nn' => 'Norwegian Nynorsk',
            'no' => 'Norwegian',
            'nr' => 'South Ndebele',
            'nv' => 'Navajo, Navaho',
            'ny' => 'Chichewa; Chewa; Nyanja',
            'oc' => 'Occitan',
            'oj' => 'Ojibwe, Ojibwa',
            'om' => 'Oromo',
            'or' => 'Oriya',
            'os' => 'Ossetian, Ossetic',
            'pa' => 'Panjabi, Punjabi',
            'pi' => 'Pali',
            'pl' => 'Polish',
            'ps' => 'Pashto, Pushto',
            'pt' => 'Portuguese',
            'qu' => 'Quechua',
            'rm' => 'Romansh',
            'rn' => 'Kirundi',
            'ro' => 'Romanian, Moldavian, Moldovan',
            'ru' => 'Russian',
            'rw' => 'Kinyarwanda',
            'sa' => 'Sanskrit (Sa?sk?ta)',
            'sc' => 'Sardinian',
            'sd' => 'Sindhi',
            'se' => 'Northern Sami',
            'sg' => 'Sango',
            'si' => 'Sinhala, Sinhalese',
            'sk' => 'Slovak',
            'sl' => 'Slovene',
            'sm' => 'Samoan',
            'sn' => 'Shona',
            'so' => 'Somali',
            'sq' => 'Albanian',
            'sr' => 'Serbian',
            'ss' => 'Swati',
            'st' => 'Southern Sotho',
            'su' => 'Sundanese',
            'sv' => 'Swedish',
            'sw' => 'Swahili',
            'ta' => 'Tamil',
            'te' => 'Telugu',
            'tg' => 'Tajik',
            'th' => 'Thai',
            'ti' => 'Tigrinya',
            'tk' => 'Turkmen',
            'tl' => 'Tagalog',
            'tn' => 'Tswana',
            'to' => 'Tonga (Tonga Islands)',
            'tr' => 'Turkish',
            'ts' => 'Tsonga',
            'tt' => 'Tatar',
            'tw' => 'Twi',
            'ty' => 'Tahitian',
            'ug' => 'Uighur, Uyghur',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'uz' => 'Uzbek',
            've' => 'Venda',
            'vi' => 'Vietnamese',
            'vo' => 'VolapÃƒÂ¼k',
            'wa' => 'Walloon',
            'wo' => 'Wolof',
            'xh' => 'Xhosa',
            'yi' => 'Yiddish',
            'yo' => 'Yoruba',
            'za' => 'Zhuang, Chuang',
            'zh' => 'Chinese',
            'zu' => 'Zulu'
        );

        $this->name = $languages[strtolower($this->code)];
        if (empty($this->name)) {
            $this->name = 'Unknown';
        }
    }
}
