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
		$this->Ln(10);
		
		foreach ($data as $row) {
			$year = $row[0];
			$entry = $row[1];
			$this->Cell($tableWidths[0],10,$year,0,0);
			$this->MultiCell(0,10,$entry,0,'L');
		}
	}

	public function displayExhibitionTable() {

	}
}