<?php

//namespace Drupal\rootstack_sandbox;
//
//use Symfony\Component\EventDispatcher\EventDispatcherInterface;
//use Drupal\rootstack_sandbox\Events\SomethingEvent;
//
///**
// * Defines a class for doing stuff.
// */
//class NodeFancyDisplayEvent {
//    protected $eventDispatcher;
//
//    /**
//     * Constructs a MyModuleSomething.
//     */
//    public function __construct(EventDispatcherInterface $event_dispatcher) {
//        $this->eventDispatcher = $event_dispatcher;
//    }
//
//    /**
//     * Does something.
//     */
//    public function doSomething($with_this) {
//        $event = new SomethingEvent($with_this);
//        $this->eventDispatcher->dispatch(SomethingEvent::JUST_DO_IT, $event);
//        return $event->showMeTheDoneStuff();
//    }
//}