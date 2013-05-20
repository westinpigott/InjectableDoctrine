<?php

namespace WRP\InjectableDoctrine\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of WRPInjectableDoctrineExtension
 *
 * @author Westin Pigott
 */
class WRPInjectableDoctrineExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
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
