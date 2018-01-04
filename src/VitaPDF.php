<?php

namespace yupdesign\AFKuenstler;

class VitaPDF extends \FPDF {

	/**
	 * @todo: ggf. werden Header und Footer durch ein Template ersetzt!
	 */
	public function Header() {
		$this->SetY(10);
		$this->SetFillColor(200);
		$this->Rect(154,$this->GetY(),35,10,'F');
		$this->SetY(35);
	}

	public function Footer() {
		$this->SetY(-20);
		$this->SetFillColor(200);
		$this->Rect(20,$this->GetY(),30,10,'F');
		$this->Rect(56,$this->GetY(),140,10,'F');
	}

	/**
	 * 
	 */
	public function displayBasicTable($header='',$data) {
		$this->SetY($this->GetY() + 5);
		$this->setFont('Arial','B',10);
		$this->Write(10,utf8_decode($header));
		$this->setFont('');
		$this->Ln();
		
		foreach ($data as $row) {
			$this->printDateCell($row['date_from'],$row['date_to']);
			$this->Cell(0,7,utf8_decode($row['entry_text']),'');
			$this->Ln();
		}
	}

	/**
	 * 
	 */
	public function displayExhibitionsTable($data) {
		$this->SetY($this->GetY() + 5);
		$this->setFont('Arial','B',10);
		$this->Write(10,utf8_decode($data['title']));
		$this->setFont('');
		$this->Ln();

		foreach ($data['entries'] as $row) {
			$this->printExhibCells($row);
		}
	}

	/**
	 * Die Funktion beinhaltet einen ganzen Batzen an Logik. Daher unbedingt den
	 * Kommentar lesen!
	 * 
	 * Je nach Kombination der Inputs werden unterschiedliche Tabellenfelder in
	 * der fertigen PDF erzeugt. Hierfür sind folgende Fälle vorgesehen:
	 * 
	 * [1] $from = xxxx && $to = ''
	 * In diesem Fall ist ein einzelnes Datum angegeben. Die Ausgabe erfolgt gem.
	 * der Ausrichtung als einzelnes Feld
	 * 
	 * [2] $from = '' && $to = xxxx
	 * In diesem Fall wird das Enddatum als ein 'bis' verstanden und entsprechend
	 * ausgegeben.
	 * 
	 * [3] $from = xxxx && $to = '...'
	 * Ein solcher Eintrag wird als ein noch laufender Prozess angesehen. In der
	 * PDF wird ein 'seit' generiert.
	 * 
	 * [4] $from = xxxx && $to = xxxx+1
	 * Wenn die Differenz zwischen den beiden Zeiten nur ein Jahr beträgt wird
	 * das Trennungzeichen auf ein '/' festgelegt
	 * 
	 * [5] $from = xxxx && $to = yyyy
	 * Bei allen anderen Differenz wird als normales Trennungzeichen ein '-'
	 * genutzt.
	 */
	private function printDateCell($from, $to) {

		// [1]
		if($from != '' && $to == '') {
			$this->Cell(35,7,$from);
			return;
		}

		if($from == '' && $to != '') {
			$this->Cell(35,7,'bis ' . $to);
			return;
		}

		if($from != '' && $to == '...') {
			$this->Cell(35,7,'seit ' . $from);
			return;
		}

		if($to - $from == 1) {
			$this->Cell(35,7,$from . ' / ' . $to);
			return;
		}

		if($to == '' && $from == '') {
			$this->Cell(35,7,'');
			return;
		}

		$this->Cell(35,7,$from . ' - ' . $to);
		return;
	}


	/**
	 * Die Funktion spielt in das aktuelle Ausstellungsmodul mit rein!
	 */
	private function printExhibCells($exhib) {
		$this->Cell(35,7,$exhib[1]);
		$this->Cell(0,7,$exhib[0]);
		return;
	}
}