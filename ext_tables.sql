CREATE TABLE tx_bison_domain_model_apcmax (
	euro double(11,2) NOT NULL DEFAULT '0.00',
	price int(11) NOT NULL DEFAULT '0',
	currency varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_article (
	title text NOT NULL DEFAULT '',
	doi varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_datasetstate (
	dataset varchar(255) NOT NULL DEFAULT '',
	date datetime DEFAULT NULL
);

CREATE TABLE tx_bison_domain_model_editorialprocessreview (
	process varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_isreplacedby (
	replacement varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_journal (
	idx varchar(255) NOT NULL DEFAULT '',
	retains_copyright_author smallint(1) unsigned NOT NULL DEFAULT '0',
	discontinued_date datetime DEFAULT NULL,
	editorial_board_date varchar(255) NOT NULL DEFAULT '',
	eissn varchar(255) NOT NULL DEFAULT '',
	pissn varchar(255) NOT NULL DEFAULT '',
	publication_time_weeks int(11) NOT NULL DEFAULT '0',
	publisher_country varchar(255) NOT NULL DEFAULT '',
	publisher_name varchar(255) NOT NULL DEFAULT '',
	has_preservation smallint(1) unsigned NOT NULL DEFAULT '0',
	ref_journal varchar(255) NOT NULL DEFAULT '',
	ref_author_instructions varchar(255) NOT NULL DEFAULT '',
	title varchar(255) NOT NULL DEFAULT '',
	has_apc smallint(1) unsigned NOT NULL DEFAULT '0',
	has_other_charges smallint(1) unsigned NOT NULL DEFAULT '0',
	has_pid_scheme smallint(1) unsigned NOT NULL DEFAULT '0',
	last_updated datetime DEFAULT NULL,
	doi_pid_scheme int(11) NOT NULL DEFAULT '0',
	created_date datetime DEFAULT NULL,
	aims_scope varchar(255) NOT NULL DEFAULT '',
	alternative_title text NOT NULL DEFAULT '',
	score double(11,2) NOT NULL DEFAULT '0.00',
	plan_s_compliance smallint(1) unsigned NOT NULL DEFAULT '0',
	journal_apc_max_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_article_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_editorial_review_process_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_is_replaced_by_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_keyword_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_language_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_license_m_m int(11) unsigned NOT NULL DEFAULT '0',
	journal_subject_m_m int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_bison_domain_model_keyword (
	keyword varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_language (
	lang varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_bison_domain_model_license (
	non_commercial smallint(1) unsigned NOT NULL DEFAULT '0',
	no_derivative smallint(1) unsigned NOT NULL DEFAULT '0',
	attribution smallint(1) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_bison_domain_model_subject (
	term varchar(255) NOT NULL DEFAULT ''
);
