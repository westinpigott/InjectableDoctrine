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
        
        $def = new Definition();
        $def->setClass('WRP\InjectableDoctrine\Listener\OnLoadListener');
        $def->addArgument(new Reference('event_dispatcher'));
        $def->addTag('doctrine_mongodb.odm.event_listener', array(
            'event' => 'postLoad',
        ));
        $container->setDefinition('wrp.injectable_doctrine.on_load_listener', $def);
        
    }

}

?>
