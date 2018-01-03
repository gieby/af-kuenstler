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

	public function displayBasicTable($header='',$data) {
		$this->setFont('Arial','B',10);
		$this->Write(10,$header);
		$this->setFont('Arial','',10);
		$this->Ln();
		
		foreach ($data as $row) {
			$this->setFont('Arial','',10);
			$this->Cell(40,7,$row[0],'LR');
			$this->setFont('Arial','',10);
			$this->Cell(0,7,utf8_decode($row[5]),'LR');
			$this->Ln();

			$this->Write(7,utf8_decode(implode(',',$row)));
		}
	}

	public function displayExhibitionTable() {

	}
}