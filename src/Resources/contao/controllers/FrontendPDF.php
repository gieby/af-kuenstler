<?php

namespace yupdesign\AF;

use Psr\Log\LogLevel;
use Contao\CoreBundle\Monolog\ContaoContext;
use yupdesign\AFKuenstler\VitaPDF;
use yupdesign\AFKuenstler\VitaBlock;

class FrontendPDF extends \Frontend
{
	/**
     * Initialize the object (do not remove)
     */
    public function __construct()
    {
        parent::__construct();

        // See #4099
        if (!defined('BE_USER_LOGGED_IN'))
        {
            define('BE_USER_LOGGED_IN', false);
        }
        if (!defined('FE_USER_LOGGED_IN'))
        {
            define('FE_USER_LOGGED_IN', false);
        }
    }


    /**
     * 
     */
    private function getBlocks($artist_id) {
        $objBlocks = $this->Database->prepare(
			'SELECT title, entries FROM tl_af_vitablock WHERE pid=' . $artist_id .' AND type="entries_default"'
        )->execute();

		$returnBlocks = array();

		while($objBlocks->next()) {
			$returnBlocks[$objBlocks->title] = deserialize($objBlocks->entries);
        }

        return $returnBlocks;
    }





    /**
     * Run the controller
     *
     * @return string
     */
    public function getPDF($lastname, $firstname) {


    /**
     * Die Daten für den angefragten Künstler aus der Datenbank holen
     */

    $objKuenstler = $this->Database->prepare(
        'SELECT id,firstname, lastname, profile_img FROM tl_af_kuenstler ORDER BY lastname'
      )->execute(1);


    $artist_fname = $objKuenstler->firstname;
    $artist_lname = $objKuenstler->lastname;
    $artist_image = \FilesModel::findByUuid($objKuenstler->profile_img);    
    $artist_blocks = $this->getBlocks($objKuenstler->id);

    $pdf = new VitaPDF();

    // allgemeine PDF-Einstellungen für Vita
    $pdf->SetCreator('art+form');
    $pdf->SetAuthor('art+form');
    $pdf->SetTitle($artist_fname . ' '. $artist_lname . ' - Vita');
    $pdf->SetSubject('Vita für ' . $artist_fname . ' '. $artist_lname);
    $pdf->SetMargins(29.7,14,14);

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Write(10,$artist_fname . ' '. $artist_lname);
    $pdf->Ln();
    
    if($artist_image != null) {
        $pdf->Image($artist_image->path,null,null,50);
        $pdf->Ln(10);
    }

    foreach ($artist_blocks as $title => $entries) {
        $pdf->displayBasicTable($title,$entries);
    }

    // fertige PDF als String zurück an den Controller schicken
    $finished_pdf = $pdf->Output('S',standardize(ampersand('vita', false)) . '.pdf', 'D');


    // @todo nur zu Debugzwecken ?
    \System::getContainer()
    ->get('monolog.logger.contao')
    ->log(LogLevel::INFO, 'PDF erstellt für ' . $artist_fname . ' ' . $artist_lname, array(
    'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_GENERAL
    )));

    return $finished_pdf;
    }
}