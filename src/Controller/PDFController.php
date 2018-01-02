<?php

namespace yupdesign\AFKuenstler\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use yupdesign\AF\GeneratePDF;

class PDFController extends Controller {

	/**
	 * @return JsonResponse
	 * 
	 * @Route("/pdf/{firstname}/{lastname}", name="artist_pdf", defaults={"_scope" = "frontend", "_token_check" = false})
	 */
	public function pdfAction($firstname='',$lastname='')
	{
		$this->container->get('contao.framework')->initialize();

		$controller = new \yupdesign\AF\GeneratePDF();

		$data = $controller->getPDF($firstname,$lastname);
		$data .= 'blubb';

		$response = new JsonResponse($data);
		$response->send();
	}
}