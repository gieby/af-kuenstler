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
}