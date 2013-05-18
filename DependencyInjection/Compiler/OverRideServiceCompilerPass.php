<?php

namespace WRP\InjectableDoctrine\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of OverRideServiceCompilerPass
 *
 * @author Westin Pigott
 */
class OverRideServiceCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
        $container->setParameter('doctrine_mongodb.odm.document_manager.class', 'WRP\InjectableDoctrine\Model\DocumentManager');
        $definition = $container->getDefinition('doctrine_mongodb.odm.default_document_manager');        
        $definition->addMethodCall('setEventDispatcher', array(new Reference('event_dispatcher')));
        
    }

}

?>
