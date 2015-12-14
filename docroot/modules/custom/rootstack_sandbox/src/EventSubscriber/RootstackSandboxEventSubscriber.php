<?php
/**
 * @file
 * Contains Drupal\rootstack_sandbox\RootstackSandboxEventSubscriber.
 */

namespace Drupal\rootstack_sandbox\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RootstackSandboxEventSubscriber implements EventSubscriberInterface {

    static function getSubscribedEvents() {
        $events['rootstack_sandbox.fancy_node_edit'][] = array('onFancyNodesEdit', 20);
        return $events;
    }

    public function onFancyNodesEdit($event) {
        $nodes = $event->getFancyNodes();
        foreach ($nodes as $nid => &$node) {
            $node = "my $nid is $node";
        }
        $event->setFancyNodes($nodes);
//        $event->stopPropagation();
        drupal_set_message('tst');
    }

}
