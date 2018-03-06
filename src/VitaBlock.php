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
}