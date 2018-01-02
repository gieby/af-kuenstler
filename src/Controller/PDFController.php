<?php

namespace yupdesign\AFKuenstler\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

		$controller = new GeneratePDF();

		$data = $controller->getPDF($firstname,$lastname);

		$response = new JsonResponse($data);
		$response->send();
	}
}