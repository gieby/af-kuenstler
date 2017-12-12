<?php

/**
 * Die Tabelle listet alle Künstler auf.
 * An ihr werden nur allgemeine Informationen wie Name, Homepage, Bild usw.
 * hinterlegt. Alle weiteren Informationen werden auf die Blöcke aufgeteilt.
 */

$GLOBALS['TL_DCA']['tl_af_kuenstler'] = array
(

	'config' => array
	(
		'dataContainer'			=> 'Table',
		'enableVersioning'	=> true,
		'sql'								=> array
		(
			'keys' => array
			(
				'id'				=> 'primary',
				'lastname'	=> 'index'
			)
		)
	),


	'list' => array
	(
		'sorting'	=> array
		(
			'mode'						=> 1,
			'fields'					=> array('lastname'),
			'disableGrouping'	=> true
		),

		'label'	=> array
		(
			'fields'					=> array('lastname', 'firstname'),
			'format'					=> '%s, %s'
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
				'icon'				=> 'edit.gif',
				'attributes'	=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			)
		)
	),


	'palettes'	=> array
	(
		'default'	=> 'firstname, lastname;'
	),


	'fields'	=> array
	(
		'id'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp'	=> array
		(
			'sql'	=> "int(10) unsigned NOT NULL default '0'"
		),
		'firstname'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['firstname'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>true, 'unique'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'lastname'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['lastname'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>true, 'unique'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		)
	)
)