<?php

namespace yupdesign\AFKuenstler;

class VitaPDF extends \FPDF {

	public function Header() {
		$this->SetFont('helvetica','B',20);
		$this->Cell(0,15,'Vita',0,false,'C',0,'',0,false,'M','M');
	}

	public function Footer() {

	}
}