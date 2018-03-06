<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['kuenstler_inhalt'] = '{type_legend},type,kuenstler;{template_legend:hide},customTpl;{protected_legend:hide},protected;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['kuenstler']	= array
(
	'label'             	=> &$GLOBALS['TL_LANG']['tl_content']['kuenstler'],
    'exclude'           => true,
    'inputType'         => 'select',
    'options_callback'  => array('yupdesign\AFKuenstler\VitaBlock', 'getKuenstlerIDs'),
    'eval'              => array('mandatory' => true, 'includeBlankOption' => true,'tl_class' => 'w50'),
    'sql'               => "int(10) unsigned NOT NULL default '0'"
);