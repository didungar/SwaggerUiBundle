<?php

namespace DidUngar\SwaggerUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	/**
	 * @Route("/swaggerui", name="didungar_swaggerui")
	 * @Template("Default/swaggerui.html.twig")
	 */
	public function swaggeruiAction()
	{
		return [
			'swagger_json'=>$this->getParameter('didungar_swaggerui.swagger_json'),
		];
	}
}
