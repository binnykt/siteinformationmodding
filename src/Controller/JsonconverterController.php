<?php

namespace Drupal\siteinfo_modding\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonconverterController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function delivernodejson($apikey, $nid) {
    
    if(!isset($nid) && !isset($apikey)) {
       throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }

    // Getting the default api key stored in our form
    $config = \Drupal::config('system.site'); 
    $default_apikey = $config->get('siteapikey');

    if($apikey == $default_apikey) {
	  $response = new JsonResponse();
	  $node = Node::load($nid);
	  $data = array(
	    'node' => array(
	    'title' => $node->get('title')->getValue()[0]['value'],
	    'body' => $node->get('body')->getValue()[0]['value'],
	   )
	  );

	  $response->setData($data);

      return $response;
    }
    else {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }
  }
}