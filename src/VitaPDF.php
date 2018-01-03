<?php

namespace yupdesign\AFKuenstler;

class VitaPDF extends \FPDF {

	/**
	 * @todo: ggf. werden Header und Footer durch ein Template ersetzt!
	 */
	public function Header() {

	}

	public function Footer() {

	}

	public function displayBasicTable($header, $data) {
		$this->setFont('Arial','B',18);
		$this->Cell('');
	}

	public function displayExhibitionTable() {

	}
}