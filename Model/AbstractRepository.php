<?php

namespace WRP\InjectableDoctrine\Model;

use WRP\InjectableDoctrine\Interfaces\RepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use WRP\InjectableDoctrine\Event\DoctrineObjectInstantiationEvent;
use WRP\InjectableDoctrine\Interfaces\EventDispatcherAware;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use \Exception as Exception;

/**
 * Description of AbstractRepository
 *
 * @author Westin Pigott
 */
abstract class AbstractRepository extends DocumentRepository implements RepositoryInterface, EventDispatcherAware {

    private $eventDispatcher;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return EventDispatcherInterface
     */
    protected function getEventDispatcher() {
        if (!($this->eventDispatcher instanceof EventDispatcherInterface))
            throw new Exception('Event Dispatcher must be injected using setEventDispatcher prior to use.');
        return $this->eventDispatcher;
    }

    /**
     * 
     * @return mixed
     */
    public function createNewObject() {
        $className = $this->getClassName();
        $object = new $className();
        $event = new DoctrineObjectInstantiationEvent($object);
        $this->getEventDispatcher()->dispatch(DoctrineObjectInstantiationEvent::EVENT_INSTANTIATE_OBJECT, $event);
        return $object;
    }

}

?>
