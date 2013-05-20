<?php

namespace WRP\InjectableDoctrine\Model;

use WRP\InjectableDoctrine\Interfaces\RepositoryInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\MongoDB\DocumentRepository;
use WRP\InjectableDoctrine\Event\DoctrineObjectInstantiationEvent;
use WRP\InjectableDoctrine\Interfaces\EventDispatcherAware;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WRP\InjectableDoctrine\Exceptions\InjectableDoctrineException;

/**
 * Description of AbstractRepository
 *
 * @author Westin Pigott
 */
abstract class AbstractRepository extends DocumentRepository implements RepositoryInterface {

    private $eventDispatcher;

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher) {
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

    /**
     * 
     * @return mixed
     */
    public function createNewObject($className = NULL) {
        if (is_null($className))
            $className = $this->getClassName();
        $object = new $className();
        $event = new DoctrineObjectInstantiationEvent($object);
        $this->getEventDispatcher()->dispatch(DoctrineObjectInstantiationEvent::EVENT_INSTANTIATE_OBJECT, $event);
        return $object;
    }

}

?>
