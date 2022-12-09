<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal',
        'label' => 'idx',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'idx,editorial_board_date,eissn,pissn,publisher_country,publisher_name,ref_journal,ref_author_instructions,title,aims_scope,alternative_title',
        'iconfile' => 'EXT:bison/Resources/Public/Icons/tx_bison_domain_model_journal.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'idx, retains_copyright_author, discontinued_date, editorial_board_date, eissn, pissn, publication_time_weeks, publisher_country, publisher_name, has_preservation, ref_journal, ref_author_instructions, title, has_apc, has_other_charges, has_pid_scheme, last_updated, doi_pid_scheme, created_date, aims_scope, alternative_title, score, plan_s_compliance, journal_apc_max_m_m, journal_article_m_m, journal_editorial_review_process_m_m, journal_is_replaced_by_m_m, journal_keyword_m_m, journal_language_m_m, journal_license_m_m, journal_subject_m_m, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_bison_domain_model_journal',
                'foreign_table_where' => 'AND {#tx_bison_domain_model_journal}.{#pid}=###CURRENT_PID### AND {#tx_bison_domain_model_journal}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'idx' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.idx',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'retains_copyright_author' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.retains_copyright_author',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'discontinued_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.discontinued_date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'editorial_board_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.editorial_board_date',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'eissn' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.eissn',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'pissn' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.pissn',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'publication_time_weeks' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.publication_time_weeks',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'publisher_country' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.publisher_country',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'publisher_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.publisher_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'has_preservation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.has_preservation',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'ref_journal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.ref_journal',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'ref_author_instructions' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.ref_author_instructions',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'has_apc' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.has_apc',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'has_other_charges' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.has_other_charges',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'has_pid_scheme' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.has_pid_scheme',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'last_updated' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.last_updated',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'doi_pid_scheme' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.doi_pid_scheme',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'created_date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.created_date',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'aims_scope' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.aims_scope',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'alternative_title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.alternative_title',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'score' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.score',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'plan_s_compliance' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.plan_s_compliance',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'journal_apc_max_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_apc_max_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_apcmax',
                'MM' => 'tx_bison_journal_apcmax_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_article_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_article_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_article',
                'MM' => 'tx_bison_journal_article_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_editorial_review_process_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_editorial_review_process_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_editorialprocessreview',
                'MM' => 'tx_bison_journal_editorialprocessreview_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_is_replaced_by_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_is_replaced_by_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_isreplacedby',
                'MM' => 'tx_bison_journal_isreplacedby_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_keyword_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_keyword_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_keyword',
                'MM' => 'tx_bison_journal_keyword_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_language_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_language_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_language',
                'MM' => 'tx_bison_journal_language_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_license_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_license_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_license',
                'MM' => 'tx_bison_journal_license_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'journal_subject_m_m' => [
            'exclude' => true,
            'label' => 'LLL:EXT:bison/Resources/Private/Language/locallang_db.xlf:tx_bison_domain_model_journal.journal_subject_m_m',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_bison_domain_model_subject',
                'MM' => 'tx_bison_journal_subject_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
    
    ],
];
