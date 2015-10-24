<?php

/**
 * @file
 * Contains Drupal\rootstack_sandbox\Controller\NodeFancyDisplayController.
 */

namespace Drupal\rootstack_sandbox\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Entity\Query\QueryFactory;
use Drupal\Core\Entity\EntityManager;

/**
 * Class NodeFancyDisplayController.
 *
 * @package Drupal\rootstack_sandbox\Controller
 */
class NodeFancyDisplayController extends ControllerBase {
  protected $entity_query;
  protected $database;
  protected $entity_manager;

  public function __construct(Connection $database, QueryFactory $entity_query, EntityManager $entity_manager) {
    $this->database = $database;
    $this->entity_query = $entity_query;
    $this->entity_manager = $entity_manager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('entity.query'),
      $container->get('entity.manager')
    );
  }

  public function index($count) {
//    Esta forma de llevar a cabo conexiones es mas rapida sin usar dependency injection
//    sin embargo es considerada mala practica (puntos para el que explique porque)
//    $connection = \Drupal::database();
    $select = $this->database->select('node', 'n');
    $select->fields('n');
    $select->range(0, $count);
    $result = $select->execute()->fetchAll();
    dpm($result);

    $query = $this->entity_query->get('node');
    $query->condition('status', 1);
    $query->range(0, $count);
    $result = $query->execute();
    dpm($result);

    $storage = $this->entity_manager->getStorage('node');
    dpm($storage->loadMultiple($result));

    return [
      '#theme' => 'fancy_nodes',
    ];
  }

}
