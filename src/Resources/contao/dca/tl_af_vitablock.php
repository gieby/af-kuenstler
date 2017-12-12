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
				'id'				=> 'primary'
			)
		)
	),

	'list' => array
	(
		'sorting'	=> array
		(
			'mode'						=> 4,
			'fields'					=> array('id'),
			'disableGrouping'	=> true,
			'panelLayout'			=> 'filter,search'
		),

		'label'	=> array
		(
			'fields'					=> array('title'),
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


	'fields'	=> array
	(
		'id'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array(
			'foreignKey' => 'tl_af_kuenstler.id',
			'sql' => "int(10) unsigned NOT NULL default '0'",
			'relation' => array('type' => 'belongsTo', 'load' => 'eager'),
		),
		'tstamp'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL default '0'"
		)
	)
);