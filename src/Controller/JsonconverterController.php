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

    $response = new JsonResponse();
    $config = \Drupal::config('system.site');
    $node = Node::load($nid);
    $data = array(
      'date' => $apikey,
      'site_name' => $config->get('name'),
      'site_email' => $config->get('mail'),
      'random_node' => array(
        'title' => $node->get('title')->getValue()[0]['value'],
        'body' => $node->get('body')->getValue()[0]['value'],
      )
    );

    $response->setData($data);

    return $response;

  }
}