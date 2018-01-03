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
		$this->setFont('');
		$this->Ln();
		
		foreach ($data as $row) {
			$this->Cell(40,7,$row->date_from,'');
			$this->Cell(0,7,utf8_decode($row->entry_text),'');
			$this->Ln(7);
		}
	}

	public function displayExhibitionTable() {

	}
}