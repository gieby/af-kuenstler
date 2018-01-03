<?php

namespace yupdesign\AFKuenstler;

class VitaPDF extends \FPDF {

	private $tableWidths = [40,100];

	/**
	 * @todo: ggf. werden Header und Footer durch ein Template ersetzt!
	 */
	public function Header() {

	}

	public function Footer() {

	}

	public function displayBasicTable($header='', $data) {
		$this->setFont('Arial','B',12);
		$this->Cell(0,10,$header,1,0,'C');
		
		foreach ($data as $row) {
			$this->Cell()
		}
	}

	public function displayExhibitionTable() {

	}
}