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
		$this->setFont('Arial','B',10);
		$this->Write(10,$header);
		$this->Ln();
		$this->setFont('');

		foreach ($data as $row) {
			$year = $row[0];
			$entry = $row[1];
			$this->Cell(40,10,$year);
			$this->Cell(0,10,$entry);
			$this->Ln();
		}
	}

	public function displayExhibitionTable() {

	}
}