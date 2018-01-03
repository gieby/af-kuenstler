<?php

namespace yupdesign\AF;

use Psr\Log\LogLevel;
use Contao\CoreBundle\Monolog\ContaoContext;
use yupdesign\AFKuenstler\VitaPDF;

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
     * Run the controller
     *
     * @return string
     */
    public function getPDF($lastname, $firstname) {


    /**
     * Die Daten für den angefragten Künstler aus der Datenbank holen
     */

    $objKuenstler = $this->Database->prepare(
        'SELECT firstname, lastname, profile_img FROM tl_af_kuenstler ORDER BY lastname'
      )->execute(1);

    $artist_fname = $objKuenstler->firstname;
    $artist_lname = $objKuenstler->lastname;
    $artist_image = \FilesModel::findByUuid($this->profile_img)->$path;

    

    $pdf = new VitaPDF();

    // allgemeine PDF-Einstellungen für Vita
    $pdf->SetCreator('art+form');
    $pdf->SetAuthor('art+form');
    $pdf->SetTitle($artist_fname . ' '. $artist_lname . ' - Vita');
    $pdf->SetSubject('Vita für ' . $artist_fname . ' '. $artist_lname);

    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,$artist_fname . ' '. $artist_lname);
    $pdf->Ln(10);
    $pdf->Image($artist_image);
    $pdf->Ln(10);
    $pdf->displayBasicTable('Testweise',[['01.01.2018','Neujahr'],['02.01.2018','Kein Neujahr']]);
    
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