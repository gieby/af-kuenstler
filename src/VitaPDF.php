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

	public function displayBasicTable($header='', $data) {
		$this->setFont('Arial','B',6);
		$this->Write(8,$header);
		$this->Ln();
		$this->setFont('');
		
		foreach ($data as $row) {
			$year = $row[0];
			$entry = $row[1];
			$this->Cell(40,8,$year,'LR');
			$this->Cell(0,8,$entry,'LR');
			$this->Ln()
		}
	}

	public function displayExhibitionTable() {

	}
}