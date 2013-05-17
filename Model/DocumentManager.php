<?php

namespace WRP\InjectableDoctrine\Model;

use Doctrine\ODM\MongoDB\DocumentManager as ORM_DocumentManager;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\Common\EventManager;
use Doctrine\MongoDB\Connection;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WRP\InjectableDoctrine\Interfaces\EventDispatcherAware;
use \Excepton as Exception;

/**
 * Description of DocumentManager
 * Replacement of the default doctrine document manager.  Allows repositories to have access to the container.
 *
 * @author Westin Pigott
 */
class DocumentManager extends ORM_DocumentManager implements EventDispatcherAware {

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
     * Creates a new Document that operates on the given Mongo connection
     * and uses the given Configuration.
     *
     * @static
     * @param \Doctrine\MongoDB\Connection|null $conn
     * @param Configuration|null $config
     * @param \Doctrine\Common\EventManager|null $eventManager
     * @return DocumentManager
     */
    public static function create(Connection $conn = null, Configuration $config = null, EventManager $eventManager = null) {
        return new DocumentManager($conn, $config, $eventManager);
    }

    public function getRepository($entityName) {
        $repository = parent::getRepository($entityName);

        //check if it implements EventDispatcherAware
        if ($repository instanceof EventDispatcherAware)
            $repository->injectEventDispatcher($this->getEventDispatcher());

        return $repository;
    }

}

?>
