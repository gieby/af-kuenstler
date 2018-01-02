<?php

namespace yupdesign\AFKuenstler\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PDFController extends Controller {

	/**
	 * @Route("/pdf/{firstname}-{lastname}", name="kuenstler_pdf", defaults={"_scope" = "frontend", "_token_check" = false})
	 */
	public function pdfAction($firstname='',$lastname='')
	{
		$this->container->get("contao.fromework")->initialize();

		$controller = new \yupdesign\AFKuenstler\GeneratePDF();

		if($firstname != '' && $lastname != '') {
		
		}

		$data = $controller->getPDF($firstname,$lastname);
	}
}