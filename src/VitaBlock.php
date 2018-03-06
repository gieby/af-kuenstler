<?php

namespace yupdesign\AFKuenstler;

class VitaBlock extends \Backend
{
  /**
	 * @return string
	 */
	public function listBlocks($arrRow)
	{
		return '<div class="tl_content_left">' . $GLOBALS['TL_LANG']['tl_af_vitablock']['type_ref'][$arrRow['type']] . '</div>';
	}
	
	/**
	 * @return string
	 */
	public function getKuenstlerIDs()
	{
		$arrKuenstler = array();
		$objKuenstler = $this->Database->execute("SELECT id, firstname, lastname FROM tl_af_kuenstler");

		while ($objKuenstler->next()) {
			$arrKuenstler[$objKuenstler->id] = $objKuenstler->firstname . ' ' . $objKuenstler->lastname;
		}

		return $arrKuenstler;

	}
}