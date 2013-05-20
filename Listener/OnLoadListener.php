<?php

namespace WRP\InjectableDoctrine\Listener;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WRP\InjectableDoctrine\Exceptions\InjectableDoctrineException;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use WRP\InjectableDoctrine\Event\DoctrineObjectInstantiationEvent;

/**
 * Description of OnLoadListener
 *
 * @author Westin Pigott
 */
class OnLoadListener {

    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getEventDispatcher() {
        if (!($this->eventDispatcher instanceof EventDispatcherInterface))
            throw new InjectableDoctrineException('Event Dispatcher must be injected using setEventDispatcher prior to use.');
        return $this->eventDispatcher;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $object = $args->getDocument();
        $event = new DoctrineObjectInstantiationEvent($object);
        $this->getEventDispatcher()->dispatch(DoctrineObjectInstantiationEvent::EVENT_INSTANTIATE_OBJECT, $event);
    }

}

?>
