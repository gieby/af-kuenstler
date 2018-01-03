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

    

    $pdf = new VitaPDF();

    //
    $pdf->SetCreator('art+form');
    $pdf->SetAuthor('art+form');
    $pdf->SetTitle($objKuenstler->firstname . ' '. $objKuenstler->lastname . ' - Vita');
    $pdf->SetSubject('Vita für ' . $objKuenstler->firstname . ' '. $objKuenstler->firstname);
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(40,10,$objKuenstler->firstname . ' '. $objKuenstler->lastname);
    $pdf->Ln(10);
    $pdf->displayBasicTable('Testweise',['blar']);
	$finished_pdf = $pdf->Output('S',standardize(ampersand('vita', false)) . '.pdf', 'D');

    \System::getContainer()
    ->get('monolog.logger.contao')
    ->log(LogLevel::INFO, 'PDF erstellt für ' . $objKuenstler->firstname . ' ' . $objKuenstler->firstname, array(
    'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_GENERAL
    )));

    return $finished_pdf;
    }
}