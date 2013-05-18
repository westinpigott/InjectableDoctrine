<?php

namespace WRP\InjectableDoctrine;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use WRP\InjectableDoctrine\DependencyInjection\Compiler\OverRideServiceCompilerPass;
use WRP\InjectableDoctrine\DependencyInjection\Compiler\DefineListenerCompilerPass;
use WRP\InjectableDoctrine\DependencyInjection\InjectableDoctrineExtension;

class WRPInjectableDoctrineBundle extends Bundle {

    public function build(ContainerBuilder $container) {
        parent::build($container);
        $container->addCompilerPass(new DefineListenerCompilerPass(), PassConfig::TYPE_OPTIMIZE);
        $container->addCompilerPass(new OverRideServiceCompilerPass(), PassConfig::TYPE_AFTER_REMOVING);
    }

}
