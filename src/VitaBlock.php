<?php

namespace yupdesign\AFKuenstler;

class VitaBlock extends \Backend
{
  /**
	 * Add the type of input field
	 *
	 * @return string
	 */
	public function listBlocks($arrRow)
	{
		return '<div class="tl_content_left">' . $arrRow['id'] . '</div>';
	}
}