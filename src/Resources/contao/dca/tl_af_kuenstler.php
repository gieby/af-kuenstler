<?php

namespace yupdesign\AFKuenstler;

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
		'ctable'						=> array('tl_af_vitablock'),
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
			'disableGrouping'	=> true,
			'panelLayout'			=> 'search'
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
			'edit_blocks' => array
			(
			 'label'               => &$GLOBALS['TL_LANG']['tl_cuaprojects']['edit_blocks'],
			 'href'                => 'table=tl_af_vitablock',
			 'icon'                => 'article.gif'
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
		'default'	=> 'firstname, lastname, homepage;profile_img,profile_copyright;{debug_legend:hidden},alias'
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
			'search'		=> true,
			'filter'		=> true,
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'lastname'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['lastname'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>true, 'unique'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
			'search'		=> true,
			'filter'		=> true,
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'alias' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['alias'],
			'inputTyoe'	=> 'text',
			'exclude'                 => true, 
			'inputType'               => 'text', 
			'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'), 
			'save_callback' => array 
			( 
					array('tl_af_kuenstler_helper', 'generateAlias') 
			), 
			'sql'                     => "varbinary(128) NOT NULL default ''" 
		),
		'homepage'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['homepage'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>false, 'unique'=>false, 'maxlength'=>128, 'tl_class'=>'w50', 'rgxp' => 'url'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
		'profile_img' => array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['profile_img'],
			'inputType'	=> 'fileTree',
			'eval'			=> array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'long'),
			'sql'				=> "binary(16) NULL"
		),
		'profile_copyright'	=> array
		(
			'label'			=> &$GLOBALS['TL_LANG']['tl_af_kuenstler']['profile_copyright'],
			'inputType'	=> 'text',
			'eval'			=> array('mandatory'=>false, 'unique'=>false, 'maxlength'=>128, 'tl_class'=>'w50'),
			'sql'				=> "varchar(128) NOT NULL default ''"
		),
	)
);

class tl_af_kuenstler_helper extends \Backend {
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function generateAlias($varValue, DataContainer $dc) 
    { 
        $autoAlias = false; 

        // Generate an alias if there is none 
        if ($varValue == '') 
        { 
            $autoAlias = true; 
            $varValue = standardize(String::restoreBasicEntities($dc->activeRecord->title)); 
        } 

        $objAlias = $this->Database->prepare("SELECT id FROM tl_af_kuenstler WHERE id=? OR alias=?") 
                                   ->execute($dc->id, $varValue); 

        // Check whether the page alias exists 
        if ($objAlias->numRows > 1) 
        { 
            if (!$autoAlias) 
            { 
                throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue)); 
            } 

            $varValue .= '-' . $dc->id; 
        } 

        return $varValue; 
    }  
}