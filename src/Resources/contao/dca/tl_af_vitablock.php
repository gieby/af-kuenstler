<?php

namespace yupdesign\AFKuenstler;

$GLOBALS['TL_DCA']['tl_af_vitablock'] = array
(
	
	'config' => array
	(
		'dataContainer'			=> 'Table',
		'enableVersioning'	=> true,
		'ptable'						=> 'tl_af_kuenstler',
		'sql'								=> array
		(
			'keys' => array
			(
				'id'				=> 'primary',
				'pid'				=> 'index'
			)
		)
	),

	'list' => array
	(
		'sorting'	=> array
		(
			'mode'										=> 4,
			'fields'									=> array('sorting'),
			'headerFields'						=> array('lastname', 'firstname'),
			'panelLayout'							=> 'filter,search',
			'child_record_callback'   => array('yupdesign\\AFKuenstler\\VitaBlock', 'listBlocks')
		),

		'label'	=> array
		(
			'fields'					=> array('id'),
			'format'					=> '%s'
		),

		'operations' => array
		(
			'edit'	=> array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['edit'],
				'href'				=> 'act=edit',
				'icon'				=> 'edit.gif'
			),
			'delete'	=> array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['delete'],
				'href'				=> 'act=delete',
				'icon'				=> 'delete.gif',
				'attributes'	=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			)
		)
	),

	'palettes'	=> array
	(
		'default'	=> '{entry_legend},title,type,block_short,block_long,block_pdf;{entries_legend},entries'
	),


	'fields'	=> array
	(
		'id'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey' => 'tl_af_vitablock.id',
			'sql' => "int(10) unsigned NOT NULL default '0'",
			'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
		),
		'tstamp'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
		(
			'sql'	=> "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_title'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'type'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['lastname'],
			'inputType'	=> 'select',
			'options'		=> array('default','af_exhibition'),
			'reference'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['type_ref'],
			'eval'			=> array('tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'block_short'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_short'],
			'inputType'	=> 'checkbox',
			'default'		=> 1,
			'eval'			=> array('tl_class'=>'w50'),
			'sql'				=> "char(1) NOT NULL default ''"
		),
		'block_long'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_long'],
			'inputType'	=> 'checkbox',
			'default'		=> 1,
			'eval'			=> array('tl_class'=>'w50'),
			'sql'				=> "char(1) NOT NULL default ''"
		),
		'block_pdf'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_pdf'],
			'inputType'	=> 'checkbox',
			'default'		=> 1,
			'eval'			=> array('tl_class'=>'w50'),
			'sql'				=> "char(1) NOT NULL default ''"
		),
		'entries' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['entries'],
			'exclude'		=> true,
			'inputType'	=> 'multiColumnWizard',
			'eval'			=> array
			(
				'columnFields'	=> array
				(
					'date_from'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['date_from'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'rgxp'	=> 'natural', 'maxlength' => 4, 'minlenth' => 4, 'style'	=> "width: 100px"
						)
					),
					'date_to'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['date_to'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'rgxp'	=> 'digit', 'maxlength' => 4, 'style'	=> "width: 100px"
						)
					),
					'display_short'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_short'],
						'inputType'	=> 'checkbox',
						'default'	=> 1
					),	
					'display_long'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_long'],
						'inputType'	=> 'checkbox',
						'default'	=> 1
					),	
					'display_pdf'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_pdf'],
						'inputType'	=> 'checkbox',
						'default'	=> 1
					),	
					'entry_text'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['entry_text'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'style'	=> "width: 100px"
						)
					)
				)
			),
			'sql'	=> "BLOB null"
		)
	)
);