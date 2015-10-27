<?php

/**
 * @file
 * Contains Drupal\rootstack_sandbox\NodeFancyDisplayEvent.
 */

namespace Drupal\rootstack_sandbox;

use Symfony\Component\EventDispatcher\Event;

class NodeFancyDisplayEvent extends Event {

    protected $nodes;

    public function __construct($nodes) {
        $this->nodes = $nodes;
    }

    public function getFancyNodes() {
        return $this->nodes;
    }

    public function setFancyNodes($nodes) {
        $this->nodes = $nodes;
    }

}