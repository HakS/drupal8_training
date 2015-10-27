<?php

/**
 * @file
 * Contains Drupal\rootstack_crappy_nodes\RootstackCrappyNodesSubscriber.
 */

namespace Drupal\rootstack_crappy_nodes\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class RootstackCrappyNodesSubscriber.
 *
 * @package Drupal\rootstack_crappy_nodes
 */
class RootstackCrappyNodesSubscriber implements EventSubscriberInterface {
  /**
   * Constructor.
   */
  public function __construct() {

  }
/**
* Registers the methods in this class that should be listeners.
*
* @return array
*   An array of event listener definitions.
*/
static function getSubscribedEvents() {

  $events['rootstack_sandbox.fancy_node_edit'] = array('onFancyNodeEdit', 10);
  return $events;
}

/**
 * This method is called whenever the rootstack_sandbox.fancy_node_edit event is
 * dispatched.
 *
 * @param GetResponseEvent $event
 */
 public function onFancyNodeEdit(GetResponseEvent $event) {
   dpm($event);
 }

}
