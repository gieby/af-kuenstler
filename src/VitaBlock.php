<?php

namespace yupdesign\AFKuenstler;

class VitaBlock extends \Backend
{
  /**
	 * @return string
	 */
	public function listBlocks($arrRow)
	{
		return '<div class="tl_content_left">' . $arrRow['title'] . '</div>';
	}

	/**
	 * @return array
	 */
	public function getBlocks($artist_id) {
		if($artist_id == '') {
			throw new Exception("Missing identifier", 1);
		}

		$objBlocks = $this->Database->prepare(
			'SELECT title, entries FROM tl_af_vitablock WHERE pid=' . $artist_id .' and type="entries_default"'
		)->execute();

		$returnBlocks = array();

		while($objBlocks->next()) {
			$returnBlocks[$objBlocks->title] = deserialize($objBlocks->entries);
		}

		return $returnBlocks;
	}
}