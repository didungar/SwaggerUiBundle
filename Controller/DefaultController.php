<?php

namespace DidUngar\SwaggerUiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	/**
	 * @Route("/api", name="didungar_swaggerui_apiclient")
	 * @return Response
	 */
	public function apiClientAction()
	{
		$server = $this->getParameter('api_url');
		$uri = '/';
		$url = "{$server}{$uri}";
		$result = null;
		$aPost = [];
		if ( !empty($_POST) ) {
			$server = \trim($_POST['server']);
			$uri = \trim($_POST['uri']);
			foreach($_POST['key'] as $i => $key) {
				if ( empty($key) ) continue;
				$value = $_POST['value'][$i];
				$aPost[$key] = $value;
			}
			$postdata = \http_build_query(
				$aPost
			);

			$opts = array('http' =>
							  array(
								  'method'  => 'POST',
								  'header'  => 'Content-type: application/x-www-form-urlencoded',
								  'content' => $postdata
							  )
			);

			$context  = \stream_context_create($opts);

			$result = @\file_get_contents($url = "{$server}{$uri}", false, $context);
			if ( $result ) {
				$result = \json_decode($result);
			} else {
				$result = \var_export($http_response_header, true);
			}
		}
		return $this->render('Default/apiClient.html.twig', [
			'server'=>$server,
			'uri'=>$uri,
			'url'=>$url,
			'result'=>\var_export($result, true),
			'aPost'=> $aPost,
		]);

	}

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
