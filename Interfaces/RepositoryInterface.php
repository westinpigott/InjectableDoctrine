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
     * 
     * @return mixed
     */
    public function createNewObject();
}

?>
