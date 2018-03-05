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

array_insert($GLOBALS['FE_MOD'], 2, array(
	'miscellaneous' => array(
		'kuenstler_liste' => 'yupdesign\\AFKuenstler\\Module\\KuenstlerListe',
	),
	'af_pdf' => array
	(
		'pdf'	=> 'yupdesign\AF\ModulePDF',
	)
));

array_insert($GLOBALS['TL_CTE'], 2, array(
	'kuenstler' => array(
		'kuenstler_inhalt' => 'yupdesign\\AFKuenstler\\Element\\KuenstlerInhalt',
	),
));
