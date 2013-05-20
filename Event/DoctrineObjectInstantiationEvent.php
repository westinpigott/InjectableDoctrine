<?php

namespace WRP\InjectableDoctrine\Event;

use Symfony\Component\EventDispatcher\Event;
use WRP\InjectableDoctrine\Exceptions\InjectableDoctrineException;

/**
 * Description of DoctrineObjectInstantiationEvent
 *
 * @author Westin Pigott
 */
class DoctrineObjectInstantiationEvent extends Event {

    const EVENT_INSTANTIATE_OBJECT = 'injectable_doctrine.instantiate_object';

    private $object;

    public function __construct($object) {
        if (!is_object($object))
            throw new InjectableDoctrineException('Must be a valid object.');
        $this->object = $object;
    }

    public function getObject() {
        return $this->object;
    }

}

?>
