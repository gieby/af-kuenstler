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
				'label'				=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['edit'],
				'href'				=> 'act=edit',
				'icon'				=> 'edit.gif'
			),
			'delete'	=> array
			(
				'label'				=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['delete'],
				'href'				=> 'act=delete',
				'icon'				=> 'delete.gif',
				'attributes'	=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			)
		)
	),

	'palettes'	=> array
	(
		'default'	=> 'entry'
	),


	'fields'	=> array
	(
		'id'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey' => 'tl_af_kuenstler.id',
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
		'entry' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['entry'],
			'exclude'		=> true,
			'inputType'	=> 'multiColumnWizard',
			'eval'			=> array
			(
				'columnFields'	=> array
				(
					'date_from'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['date_from'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'rgxp'	=> 'natural', 'maxlength' => 4, 'minlenth' => 4, 'style'	=> "width: 100px"
						)
					),
					'date_to'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['date_to'],
						'inputType'	=> 'text',
						'eval'	=> array
						(
							'rgxp'	=> 'digit', 'maxlength' => 4, 'style'	=> "width: 100px"
						)
					),
					'display_short'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['display_short'],
						'inputType'	=> 'checkbox',
						'default'	=> true
					),	
					'display_long'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['display_long'],
						'inputType'	=> 'checkbox',
						'default'	=> true
					),	
					'display_pdf'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['display_pdf'],
						'inputType'	=> 'checkbox',
						'default'	=> true
					),	
					'entry_text'	=> array
					(
						'label'	=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['entry_text'],
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