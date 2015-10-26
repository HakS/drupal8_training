<?php

/**
 * @file
 * Contains Drupal\rootstack_sandbox\Controller\NodeFancyDisplayController.
 */

namespace Drupal\rootstack_sandbox\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class NodeFancyDisplayController.
 *
 * @package Drupal\rootstack_sandbox\Controller
 */
class NodeFancyDisplayController extends ControllerBase {
  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }

  public static function create(ContainerInterface $container) {
    return new static($container);
  }

  public function index($count) {
//    Esta forma de llevar a cabo conexiones es mas rapida sin usar dependency injection
//    sin embargo es considerada mala practica
//    $connection = \Drupal::database();
    $select = $this->container->get('database')->select('node', 'n');
    $select->fields('n');
    $select->range(0, $count);
    $result = $select->execute()->fetchAll();
//    dpm($result);

    $query = $this->container->get('entity.query')->get('node');
    $query->condition('status', 1);
    $query->range(0, $count);
    $result = $query->execute();
//    dpm($result);
//
    $entity_manager = $this->container->get('entity.manager');
    $storage = $entity_manager->getStorage('node');
    $render_controller = $entity_manager->getViewBuilder('node');
    $nodes = $storage->loadMultiple($result);
    $some_nodes = array();
    foreach ($nodes as $nid => $node) {
      $some_nodes[$nid] = $node->getTitle();
    }
//    dpm($render_controller->view(array_values($nodes)[0]));
//    dpm($nodes);

//    Generar links en D8..... http://drupal.stackexchange.com/questions/144992/how-do-you-create-a-link-in-drupal-8 :(
    return [
      '#theme' => 'fancy_nodes',
      '#summary' => $render_controller->view(array_values($nodes)[0]),
//      '#some_nodes' => $render_controller->viewMultiple($nodes),
      '#some_nodes' => $some_nodes,
      '#total' => count($nodes)
    ];
  }

}
