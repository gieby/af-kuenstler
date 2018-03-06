<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['kuenstler_inhalt'] = 'kuenstler';

$GLOBALS['TL_DCA']['tl_content']['fields']['kuenstler']	= array
(
	'label'             	=> &$GLOBALS['TL_LANG']['tl_content']['kuenstler'],
    'exclude'           => true,
    'inputType'         => 'select',
    'options_callback'  => array('\VitaBlock', 'getKuenstlerIDs'),
    'eval'              => array('mandatory' => true, 'includeBlankOption' => true,'tl_class' => 'w50'),
    'sql'               => "int(10) unsigned NOT NULL default '0'"
);