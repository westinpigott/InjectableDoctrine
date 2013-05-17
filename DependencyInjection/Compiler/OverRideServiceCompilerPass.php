<?php

namespace WRP\InjectableDoctrine\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of OverRideServiceCompilerPass
 *
 * @author Westin Pigott
 */
class OverRideServiceCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $definition = $container->getDefinition('doctrine_mongodb.odm.default_document_manager');
        $definition->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
    }

}

?>
