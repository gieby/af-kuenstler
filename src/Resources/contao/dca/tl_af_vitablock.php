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
		'__selector__' => array('type'),
		'default'	=> '{entry_legend},custom_title,type,block_short,block_long,block_pdf;{entries_legend},entries',
		'entries_vita' => '{entry_legend},type,block_short,block_long,block_pdf;{entries_legend},entries',
		'entries_default' => '{entry_legend},custom_title,type,block_short,block_long,block_pdf;{entries_legend},entries',
		'entries_af' => '{entry_legend},type,block_short,block_long,block_pdf;{af_legend},entries_af',
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
		'custom_title' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_title'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'type'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['block_type'],
			'inputType'	=> 'select',
			'options'		=> array('entries_vita','entries_default','entries_af'),
			'reference'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['type_ref'],
			'eval'			=> array('tl_class'=>'w50', 'submitOnChange' => true,),
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
				'tl_class'	=> 'long',
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
							'rgxp'	=> 'alnum', 'maxlength' => 4, 'style'	=> "width: 100px"
						)
					),
					'display_short'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_short'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px'
						)
					),	
					'display_long'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_long'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px'
						)
					),	
					'display_pdf'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_pdf'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px'
						)
					),	
					'entry_text'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['entry_text'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'tl_class'	=> "long"
						)
					)
				)
			),
			'sql'	=> "BLOB null"
		),
		'entries_af' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['entries_af'],
			'exclude'		=> true,
			'inputType'	=> 'multiColumnWizard',
			'eval'			=> array
			(
				'tl_class'	=> 'long',
				'columnFields'	=> array
				(
					'exhib_id' => array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['exhib_id'],
						'inputType'	=> 'select',
						'options_callback'  => array('\Galerieverwaltung', 'getExhibitionIDs'),
						'eval'              => array('mandatory' => true, 'includeBlankOption' => true,'tl_class' => 'long','chosen'=>true, 'style'=>'width: 100%; min-width: 400px !important;'),
					),
					'display_short'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_short'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px;'
						)
					),	
					'display_long'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_long'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px;'
						)
					),	
					'display_pdf'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_vitablock']['display_pdf'],
						'inputType'	=> 'checkbox',
						'default'	=> 1,
						'eval' => array
						(
							'style' => 'width: 65px;'
						)
					)
				)
			),
			'sql'	=> "BLOB null"
		)
	)
);