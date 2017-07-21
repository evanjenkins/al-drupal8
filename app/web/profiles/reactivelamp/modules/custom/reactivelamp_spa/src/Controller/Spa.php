<?php

namespace Drupal\reactivelamp_spa\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Site\Settings;
use Drupal\reactivelamp_spa\Json\JsonService;
use Drupal\views\Views;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Spa.
 *
 * @package Drupal\spa\Controller
 */
class Spa extends ControllerBase  {
  /**
   * @var Client
   */
  protected $client;

  protected $jsonService;

  public function __construct(JsonService $jsonService)
  {
    $this->jsonService = $jsonService;
  }

  public static function create(ContainerInterface $container)
  {
    return new static($container->get('reactivelamp_spa.json_service.default'));
  }

  private function getBackend() {
    global $base_url;
    $path = explode(':', $base_url);
    $port = array_pop($path);
    return ['path' => join(':', $path), 'port' => $port];
  }

  public function renderApp(Request $request, $id = null) {
    return [
      '#theme' => 'spa',
      '#props' => [
        'backend' => $this->getBackend()
      ]
    ];
  }

  public function renderBlog(Request $request, $page = 'page1') {
    $view = Views::getView('blog');
    $page = str_replace('page', '', $page);
    $view->setCurrentPage((int) $page);
    $view->preview('rest_export_1');
    $view->preExecute();
    $json = $view->executeDisplay('rest_export_1');
    $json = json_decode($json['#markup']);
//    foreach($json as &$node) {
//      kint(\Drupal\node\Entity\Node::load($node->nid)->get('path')->getString());
////      $node->newPath = \Drupal::service('path.alias_manager')->getAliasByPath($node->path);
//    }
//    kint($json);
    return [
      '#theme' => 'spa',
      '#attached' => [
        'drupalSettings' => [
          'props' => [
            'blog' => ['blogItems' => $json],
            'backend' => $this->getBackend()
          ]
        ]
      ]
    ];
  }

//  public function renderBlogItem(Request $request, $category = null, $path = null) {
//    kint($request);
//    return [
//      '#theme' => 'spa',
//      '#attached' => [
//        'drupalSettings' => [
//          'props' => [
//            'backend' => $this->getBackend()
//          ]
//        ]
//      ]
//    ];
//  }
}
