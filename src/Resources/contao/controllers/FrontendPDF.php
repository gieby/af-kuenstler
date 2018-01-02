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

    $pdf = new \VitaPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);

    //
    $pdf->SetCreator('art+form');
    $pdf->SetAuthor('art+form');
    $pdf->SetTitle($firstname . ' '. $lastname . ' - Vita');
    $pdf->SetSubject('Vita für ' . $firstname . ' '. $lastname);
    $pdf->SetKeywords('');
    $pdf->setFontSubsetting(false);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();
    $pdf->lastPage();
	$pdf->Output(standardize(ampersand('vita', false)) . '.pdf', 'D');

    \System::getContainer()
    ->get('monolog.logger.contao')
    ->log(LogLevel::INFO, 'PDF erstellt für' . $firstname . ' ' . $lastname, array(
    'contao' => new ContaoContext(__CLASS__.'::'.__FUNCTION__, TL_GENERAL
    )));
    return 'blar';
    }
}