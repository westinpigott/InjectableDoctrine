<?php

namespace WRP\InjectableDoctrine\Interfaces;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 *
 * @author Westin Pigott
 */
interface EventDispatcherAware {

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher);
}

?>
