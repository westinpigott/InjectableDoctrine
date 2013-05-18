<?php

namespace WRP\InjectableDoctrine\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of DefineListenerCompilerPass
 *
 * @author Westin Pigott
 */
class DefineListenerCompilerPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container) {
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
