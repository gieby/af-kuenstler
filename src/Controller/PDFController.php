<?php

namespace yupdesign\AFKuenstler\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use yupdesign\AF\FrontendPDF;

class PDFController extends Controller {

	/**
	 * @Route("/pdf/{firstname}-{lastname}", name="artist_pdf", defaults={"_scope" = "frontend", "_token_check" = false})
	 */
	public function pdfAction($firstname='',$lastname='')
	{
		$this->container->get('contao.framework')->initialize();

		$controller = new \yupdesign\AF\FrontendPDF();
		
		$data = $controller->getPDF($lastname,$firstname);

		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/pdf');

		return $response;
	}
}