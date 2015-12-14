<?php

/**
 * @file
 * Contains \Drupal\drupalinar\Controller\RootnodeController.
 */

namespace Drupal\drupalinar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RootnodeController.
 *
 * @package Drupal\drupalinar\Controller
 */
class RootnodeController extends ControllerBase {

  /**
   * Drupal\Core\Entity\EntityManager definition.
   *
   * @var Drupal\Core\Entity\EntityManager
   */
  protected $entity_manager;

  /**
   * {@inheritdoc}
   */
  public function __construct($entity_manager) {
    $this->entity_manager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Root_nodes.
   *
   * @return string
   *   Return Hello string.
   */
  public function root_nodes() {
    $storage = $this->entity_manager->getStorage('node');
    $nids = $storage->getQuery()
      ->condition('type', 'article')
      ->condition('status', 1)
      ->range(0, 2)
      ->execute();
    $nodes = $storage->loadMultiple($nids);
    $render_controller = $this->entity_manager->getViewBuilder('node');
    $view = $render_controller->viewMultiple($nodes, 'root_node');

    return [
        '#theme' => 'root_nodes',
        '#nodes' => $view
    ];
  }
  /**
   * Root_node.
   *
   * @return string
   *   Return Hello string.
   */
  public function root_node($nid) {
    return [
        '#type' => 'markup',
        '#markup' => $this->t("Implement method: root_node with parameter(s): $nid")
    ];
  }

}
