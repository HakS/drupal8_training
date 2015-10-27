<?php

/**
 * @file
 * Contains Drupal\rootstack_sandbox\Controller\NodeFancyDisplayController.
 */

namespace Drupal\rootstack_sandbox\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\rootstack_sandbox\NodeFancyDisplayEvent;

/**
 * Class NodeFancyDisplayController.
 *
 * @package Drupal\rootstack_sandbox\Controller
 */
class NodeFancyDisplayController extends ControllerBase {
  protected $container;
  protected $db;
  protected $entityQuery;
  protected $entityManager;
  protected $eventDisp;

  public function __construct($db, $entityQuery, $entityManager, $eventDisp) {
    $this->db = $db;
    $this->entityQuery = $entityQuery;
    $this->entityManager = $entityManager;
    $this->eventDisp = $eventDisp;
  }

  public static function create(ContainerInterface $container) {
    return new static(
        $container->get('database'),
        $container->get('entity.query'),
        $container->get('entity.manager'),
        $container->get('event_dispatcher')
    );
  }

  public function index($count) {
//    Esta forma de llevar a cabo conexiones es mas rapida sin usar dependency injection
//    sin embargo es considerada mala practica
//    $connection = \Drupal::database();
    $select = $this->db->select('node', 'n');
    $select->fields('n');
    $select->range(0, $count);
    $result = $select->execute()->fetchAll();
//    dpm($result);

    $query = $this->entityQuery->get('node');
    $query->condition('status', 1);
    $query->range(0, $count);
    $result = $query->execute();
//    dpm($result);

    $storage = $this->entityManager->getStorage('node');
    $render_controller = $this->entityManager->getViewBuilder('node');
    $nodes = $storage->loadMultiple($result);
    $some_nodes = array();
    foreach ($nodes as $nid => $node) {
      $some_nodes[$nid] = $node->getTitle();
    }

    $dispatcher = $this->eventDisp;
    $e = new NodeFancyDisplayEvent($some_nodes);
    $event = $dispatcher->dispatch('rootstack_sandbox.fancy_node_edit', $e);
    $some_nodes = $event->getFancyNodes();
    dpm($some_nodes);

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
