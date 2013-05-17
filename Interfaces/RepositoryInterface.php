<?php

namespace WRP\InjectableDoctrine\Interfaces;

use Doctrine\Common\Persistence\ObjectRepository;
use WRP\InjectableDoctrine\Interfaces\EventDispatcherAware;

/**
 *
 * @author Westin Pigott
 */
interface RepositoryInterface extends ObjectRepository, EventDispatcherAware {

    /**
     * Create a new object and executes the injection event using the object before returning it.
     * @param string $className (Optional) The class to instantiate.  If empty (NULL) 
     * then it will build the object the particular repository is associated with.
     * @return mixed
     */
    public function createNewObject($className = NULL);
}

?>
