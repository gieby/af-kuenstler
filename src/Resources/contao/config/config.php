<?php

// Lädt unsere eigene Gruppe nach den Inhaltselementen
array_insert($GLOBALS['BE_MOD'],1,array('af_galerie' => array()));

/* @todo eigenes Icon für unsere Gruppe 
if ('BE' === TL_MODE) {
	if (version_compare(VERSION, '4.4', '<')) {
		$GLOBALS['TL_CSS'][] = 'system/modules/notification_center/assets/backend.css';
	} else {
		$GLOBALS['TL_CSS'][] = 'system/modules/notification_center/assets/backend_svg.css';
	}
} */

$GLOBALS['BE_MOD']['af_galerie']['kuenstler'] = array (
	'tables'	=> array('tl_af_kuenstler','tl_af_vitablock')
);

/**
 * Verschieben der Galerieverwaltung in die neue Kategorie
 */
unset($GLOBALS['BE_MOD']['content']['ausstellung']);
$GLOBALS['BE_MOD']['af_galerie']['ausstellung'] = array (
	'icon'          =>  'system/modules/yd_galerieverwaltung/assets/icons/ausstellung.png',
	'tables'        =>  array('tl_ausstellung', 'tl_werk'),
	'importWerke'   =>  array('Galerieverwaltung','importWerke')
);
