<?php

/**
 * @file
 * Contains Drupal\rootstack_sandbox\Rootstack_sandboxDefaultSubscriber.
 */

namespace Drupal\rootstack_sandbox\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class Rootstack_sandboxDefaultSubscriber.
 *
 * @package Drupal\rootstack_sandbox
 */
class Rootstack_sandboxDefaultSubscriber implements EventSubscriberInterface {
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

//  return $events;
}


}
